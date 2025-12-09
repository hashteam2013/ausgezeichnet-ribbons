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


global $app;$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;

         $query_one = new query('bundesheer_namen as oi');
        $query_one->Where= " where oi.produced= 0 ORDER BY oi.Name";
        $orders_item = $query_one->ListOfAllRecords('object');


    // Instanciation of inherited class
    $pdf = new FPDF_CellFit('L','mm',array(80,15));
    $pdf->AliasNbPages();
//    $pdf->SetMargins(16.9, 4.4, 0);
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
	for($i=0;$i<1;$i++)
	{ 

	  	$pdf->AddPage();

		$pdf->SetXY(0,0);
		$pdf->SetDrawColor(255, 255, 0);
		$pdf->Cell(80,15,'',1,0,'','','');

		$pdf->SetXY(13.7,4.3);
		$pdf->SetDrawColor(0, 0, 0);
		$actual_Name = $order_item->Name;


		if(strlen($order_item->Name)>10)
		{
    		$pdf->CellFit(63,7,UTFencoder2(($order_item->Name)),0,1,'C','','','true');
		}
		else
		{
  		$pdf->Cell(63,7,UTFencoder2(($order_item->Name)),0,1,'C','','');
		}
	}
         }

    $pdf->Output('', 'Bundesheerschilder '.date('Y-m-d').'.pdf');
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script>

