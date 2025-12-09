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





class FPDF_CellFit extends FPDF {

    //Cell with horizontal scaling if text is too wide
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }

    //Cell with horizontal scaling only if necessary
    function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
    }

    //Cell with horizontal scaling always
    function CellFitScaleForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,true);
    }

    //Cell with character spacing only if necessary
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }

    //Cell with character spacing always
    function CellFitSpaceForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        //Same as calling CellFit directly
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,true);
    }

    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
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
        $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_en as batch_name,b.type as type,c.first_name as firstname,c.last_name as lastname, c.ShownName as ShownName, b.id as batch_id";
        $query_one->Where = " left join batches as b ON b.id = oi.product_id";
        $query_one->Where.= " left join customers as c ON c.id = oi.customer_id";
        $query_one->Where.= " where oi.order_id =$id ORDER BY c.last_name, c.first_name";
        $orders_item = $query_one->ListOfAllRecords('object');
    endswitch;

$ShippingCosts=$orders->total_shipping_amount;
$Discount=$orders->discount;

    // Instanciation of inherited class
    $pdf = new FPDF_CellFit('L','mm',array(80,18));
    $pdf->AliasNbPages();
//    $pdf->SetMargins(16.9, 5.9, 0);
    $pdf->SetMargins(0, 0, 0);

    $pdf->SetAutoPageBreak(false, 0);



// -------  Names  ---------


$pdf->AddFont('roboto','','roboto.php');
    $pdf->SetFont('roboto','',26);

  

$actual_firstname = "";
$actual_lastname = "";
    
    $n=0;
     foreach ($orders_item as $order_item)
      {
         $n++;
	if ($order_item->batch_id=='1037')
	{ 

	  	$pdf->AddPage();

		$pdf->SetXY(0,0);
		$pdf->SetDrawColor(255, 255, 0);
		$pdf->Cell(80,18,'',1,0,'','','');

		$pdf->SetXY(16.9,5.9);
		$pdf->SetDrawColor(0, 0, 0);
		$actual_ShownName = $order_item->ShownName;


		if(strlen($order_item->ShownName)>10)
		{
    		$pdf->CellFit(61.1,7,UTFencoder2(($order_item->ShownName)),0,1,'C','','','true');
		}
		else
		{
  		$pdf->Cell(61.1,7,UTFencoder2(($order_item->ShownName)),0,1,'C','','');
		}
	}
         }

    $pdf->Output('', 'Namensschilder zu AR-W-1'.str_pad ($orders->id,5,'0',STR_PAD_LEFT).'.pdf');
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script>

