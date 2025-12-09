

<?php //pr($trust); 
require('fpdf.php');
class PDF extends FPDF
{


function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}
}



class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

function footer()
{

      
}
function header()
{

}
    
function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}


function TextWithDirection($x, $y, $txt, $direction='R')
{
    if ($direction=='R')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',1,0,0,1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    elseif ($direction=='L')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',-1,0,0,-1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    elseif ($direction=='U')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,1,-1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    elseif ($direction=='D')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,-1,1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    else
        $s=sprintf('BT %.2F %.2F Td (%s) Tj ET',$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    if ($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
    $this->_out($s);
}

function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
{
    $font_angle+=90+$txt_angle;
    $txt_angle*=M_PI/180;
    $font_angle*=M_PI/180;

    $txt_dx=cos($txt_angle);
    $txt_dy=sin($txt_angle);
    $font_dx=cos($font_angle);
    $font_dy=sin($font_angle);

    $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    if ($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
    $this->_out($s);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
}


global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
switch ($action):
    case'view': 
        $query= new query('orders'); 
        $query->Where = "where id =$id";
        $orders = $query->DisplayOne(); 
        $newquery = new query('users');
        $newquery->where = "id = $orders->user_id";
        $trust = $newquery->DisplayOne();
        $query_one = new query('order_items as oi');
        $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_en as batch_name,b.type as type,c.first_name as firstname,c.last_name as lastname";
        $query_one->Where = " left join batches as b ON b.id = oi.product_id";
        $query_one->Where.= " left join customers as c ON c.id = oi.customer_id";
        $query_one->Where.= " where oi.order_id =$id ORDER BY c.last_name, c.first_name";
        $orders_item = $query_one->ListOfAllRecords('object');
    endswitch;

$ShippingCosts=$orders->total_shipping_amount;
$Discount=$orders->discount;

    // Instanciation of inherited class
    //$pdf = new PDF_MC_Table('L','mm',array(90,28));

    $pdf = new PDF_MC_Table('L','mm',array(90,12));
	

    $pdf->AliasNbPages();
    $pdf->SetMargins(6, 0, 0);
    $pdf->SetAutoPageBreak(false, 0);



// -------  Names  ---------


    $pdf->SetFont('Arial','',12);

  

$actual_firstname = "";
$actual_lastname = "";
    
    $n=0;
     foreach ($orders_item as $order_item)
      {
         $n++;
	if ($actual_firstname <> $order_item->firstname || $actual_lastname <> $order_item->lastname)
	{ 

            		$pdf->AddPage();

		$actual_firstname = $order_item->firstname;
		$actual_lastname = $order_item->lastname;
    		//$pdf->Cell(0,14,UTFencoder2(($order_item->firstname.' '.$order_item->lastname)),0,1);

		$pdf->TextWithRotation(85,5,UTFencoder2(($order_item->firstname.' '.$order_item->lastname)),180,0);
	}
         }

    $pdf->Output('', 'Packetiketten zu AR-W-1'.str_pad ($orders->id,5,'0',STR_PAD_LEFT).'.pdf');
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script>

