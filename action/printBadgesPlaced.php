<?php //pr($trust); 

header('Access-Control-Allow-Origin: *');

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
    $this->SetY(-23);
    $this->SetFont('','',8);
    $this->Line(20, 272, 190, 272);
    $this->Cell(56.7,4,'Hatzmann Hell OG',0,0,'L');
    $this->Cell(56.7,4,'IBAN: AT69 1420 0200 1097 0173',0,0,'L');
    $this->Cell(56.7,4,'Gerichtsstand: Leoben',0,1,'R');
    $this->Cell(56.7,4,UTFencoder2('Wienerstraße 80'),0,0,'L');
    $this->Cell(56.7,4,'BIC: EASYATW1',0,1,'L');
    $this->Cell(56.7,4,utf8_decode('8600 Bruck an der Mur'),0,0,'L');
    $this->Cell(56.7,4,'UID: ATU71872208',0,0,'L');
    $this->Cell(56.6,4,'Seite '.$this->PageNo().'/{nb}',0,0,'R');
      
}
function header()
{
    // -------  logo and address  ---------

    $this->Image('logo.jpg',20,15,180);
    $this->Ln(25);
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




    
    
function sign($n) {
  //  return ($n > 0) - ($n < 0);
if ( $n< 0 )
{
  return -1;
}
else if ( $n== 0 )
{
  return 0;
}
else
{
  return 1;
}
}







global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$userid=$app['user_info']->id;

        $query= new query('customers'); 
        $query->Where = "where id = $id and user_id=$userid";
        $customer = $query->DisplayOne(); 

if(empty($customer)==true)
{
	
    redirect(make_url('shop'));
}

if(empty($customer)==false)
{


        $customer_id=$id;
        $output = listBatch($customer_id);
        array_pop($output);

if(empty($output)==true)
{

  redirect(make_url('shop'));
}
if(empty($output)==false)
{	

    // Instanciation of inherited class
    $pdf = new PDF_MC_Table();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetMargins(20, 20,20);
    $pdf->SetAutoPageBreak(true, 28);



    $pdf->SetFont('Arial','',10);
    $pdf->Cell(0,10,'',0,1);
    $pdf->Cell(0,6,'Spangenansicht',0,1);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0,6,UTFencoder2($customer->first_name . ' ' . $customer->last_name),0,1);


    $pdf->Ln(3);




// -------  items  ---------

    // Colors, line width and bold font
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.1);


  


        
        $imageheight=10;
        $n=0;

        $x=0;
        $xOffset=140;

        $y=$pdf->GetY()+$imageheight*88/144*(sizeof($output) - sizeof($output)%3)/3;

     	
        $maxWidth=80;


    for ($i = sizeof($output)-2; $i >= 0 ; $i--)
    {

            $tempoutput=$output[$i];
            if ( isset($tempoutput['ribbon_type'])) 
            {
        
                if ($n==0)
                {
                    $totalwidth=0;
                    for($j=0;$j<3;$j++)
                    {
                        if($i-$j<0) break;
                        $imagepath=str_replace('<div class="ribbon_outer"><img src="','',$output[$i-$j]['ribbon_type']);
                        $imagepath=str_replace('" class="img-responsive"></div>','',$imagepath);
                        $imagedata = getimagesize($imagepath);

                        $totalwidth = $totalwidth + $imageheight*$imagedata[0]/ $imagedata[1];
                    }

                    $x=$xOffset-($maxWidth-$totalwidth)/2;

                }
     
                $n=$n+1;

                
                $imagepath=str_replace('<div class="ribbon_outer"><img src="','',$tempoutput['ribbon_type']);
                $imagepath=str_replace('" class="img-responsive"></div>','',$imagepath);
                $imagedata = getimagesize($imagepath);

                $width = $imageheight*$imagedata[0]/ $imagedata[1];

                $x=$x-$width;



                $pdf->Image($imagepath,$x,$y,0,$imageheight,'PNG');

                
                if ($n==3)
                {
                    $n=0;
                    $y=$y-$imageheight*88/144;

                }



            }

        }

        $pdf->SetY( $pdf->GetY() + $imageheight + $imageheight*88/144*(sizeof($output) - sizeof($output)%3)/3);
$y= $pdf->GetY();
      $yOffset= $pdf->GetY();

    $pdf->SetFont('','',8);


       $xOffset=25;
        $count=0;
      $border=5;

    foreach ($output as $tempoutput)
    {
            $count=$count+1;
	if($count<sizeof($output)){
    	$imagepath=str_replace('<div class="ribbon_outer"><img src="','',$tempoutput['ribbon_type']);
    	$imagepath=str_replace('" class="img-responsive"></div>','',$imagepath);
      	$imagedata = getimagesize($imagepath);
	$y=$y+$imageheight+6;

	if($count<=9)
	{
		$pdf->Line($xOffset-$border, $y-$border, 185, $y-$border);
	}

	if(strlen($tempoutput['ribbon_name_en'])>55)
	{
		$writestr=substr($tempoutput['ribbon_name_en'],0,52).'...';
	}
	else
	{
		$writestr=$tempoutput['ribbon_name_en'];
	}

	$pdf->Text($xOffset,$y,utf8_decode($writestr),0,1);
        	$pdf->Image($imagepath,$xOffset,$y,0,$imageheight,'PNG');

	if($count==9)
	{
		$pdf->Line($xOffset-$border, $y-$border+$imageheight+6, 185, $y-$border+$imageheight+6);
		$pdf->Line($xOffset-$border, $yOffset+$imageheight+6-$border, $xOffset-$border, $y-$border+$imageheight+6);
		$pdf->Line(185, $yOffset+$imageheight+6-$border, 185, $y-$border+$imageheight+6);
		$pdf->Line(105, $yOffset+$imageheight+6-$border, 105, $y-$border+$imageheight+6);

	        	$xOffset=110;
		$y=$yOffset;
	}


    }
}
	if($count<=9)
	{
		$pdf->Line($xOffset-$border, $y-$border+$imageheight+6, 185, $y-$border+$imageheight+6);
		$pdf->Line($xOffset-$border, $yOffset+$imageheight+6-$border, $xOffset-$border, $y-$border+$imageheight+6);
		$pdf->Line(185, $yOffset+$imageheight+6-$border, 185, $y-$border+$imageheight+6);
		$pdf->Line(105, $yOffset+$imageheight+6-$border, 105, $y-$border+$imageheight+6);
	}


    $pdf->Output('', 'Spangenansicht '.$customer->first_name . ' ' . $customer->last_name .'.pdf');
}
}
?>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script>

