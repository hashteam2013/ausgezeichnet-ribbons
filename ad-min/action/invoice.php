
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
    $this->SetY(-23);
    $this->SetFont('','',8);
    $this->Line(20, 272, 190, 272);
    $this->Cell(56.7,4,'Hatzmann Hell OG',0,0,'L');
    $this->Cell(56.7,4,'IBAN: AT69 1420 0200 1097 0173',0,0,'L');
    $this->Cell(56.7,4,'PayPal: office@ausgezeichnet.cc',0,1,'R');
    $this->Cell(56.7,4,UTFencoder2('Wienerstraße 80'),0,0,'L');
    $this->Cell(56.7,4,'BIC: BAWAATWW',0,1,'L');
    $this->Cell(56.7,4,UTFencoder2('8600 Bruck an der Mur'),0,0,'L');
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

function get_discount_string_admin($zip)
{
//	if(substr($zip,0,1)=='4' or substr($zip,0,2)=='52' or substr($zip,0,2)=='51')
//	{
//		return UTF8_encode("Aktionspreis Oberösterreich -20%");
//	}
//	if(substr($zip,0,1)=='7' or substr($zip,0,2)=='24')
//	{
//		return UTF8_encode("Aktionspreis Burgenland -20%");
//	}

	return "";
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
        $query_one -> Field = "oi.*, b.batch_image as batch_image, b.ribbon_name_en as batch_name,b.type as type, b.is_batch as is_batch2, c.first_name as firstname,c.last_name as lastname, c.ShownName as ShownName, b.ItemType as ItemType, descr.Text as text";
        $query_one->Where = " left join batches as b ON b.id = oi.product_id";
        $query_one->Where.= " left join customers as c ON c.id = oi.customer_id";
        $query_one->Where.= " left join Descriptions as descr ON descr.product_id = oi.product_id";
        $query_one->Where.= " where oi.inactive=0 AND oi.order_id =$id ORDER BY oi.pos, oi.customer_id, b.level, b.value";
        $orders_item = $query_one->ListOfAllRecords('object');
    endswitch;


        $query = new query('deliveryconditions');
        $query->Where =  " WHERE id = " . $orders->deliverycondition_id;
        $deliverycondition = $query->DisplayOne();

        $query = new query('paymentconditions');
        $query->Where = " WHERE id = " . $orders->paymentcondition_id;
        $paymentcondition = $query->DisplayOne();


$ShippingCosts=$orders->total_shipping_amount;
$Discount=$orders->discount;

    // Instanciation of inherited class
    $pdf = new PDF_MC_Table();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetMargins(20, 20,20);
    $pdf->SetAutoPageBreak(true, 28);



// -------  billing address  ---------


    $pdf->SetFont('Arial','',10);
    $pdf->Cell(0,10,'',0,1);
    $pdf->Cell(0,6,'An',0,1);


if($orders->billing_company<>"")
{
    $pdf->Cell(0,6,UTFencoder2($orders->billing_company),0,1);
}
   $pdf->Cell(0,6,UTFencoder2($orders->billing_firstname.' '.$orders->billing_lastname),0,1);
   $pdf->Cell(0,6,UTFencoder2($orders->billing_address1).' '.UTFencoder2($orders->billing_address2),0,1);
   $pdf->Cell(0,6,$orders->billing_zip.' '.UTFencoder2($orders->billing_city),0,0);
   $time=strtotime($orders->date_add);

if($orders->override_invoice_date!="")
{
   $pdf->Cell(0,10,UTFencoder2('Bruck an der Mur') . ', '.$orders->override_invoice_date,0,1,'R');
}
else
{
   $pdf->Cell(0,10,UTFencoder2('Bruck an der Mur') . ', '.date("d.m.Y",$time),0,1,'R');
}

    $pdf->Ln(10);

// -------- Invoice Text-------

       if ($orders->comment_top <> "") 
       {
            $pdf->MultiCell(0,6,UTFencoder2($orders->comment_top),0,1);
       }

    $pdf->SetFont('','B');
    $pdf->Cell(0,10,'Rechnung AR-W-1'.str_pad ($orders->id,5,'0',STR_PAD_LEFT),0,1);
    $pdf->SetFont('','');


	if($orders->override_order_date!="")
	{

    		$pdf->Write(6, 'Sehr geehrte Damen und Herren, entsprechend Ihrer Bestellung vom ' . $orders->override_order_date . ' stellen wir folgende Leistungen in Rechnung:');

	}
	else
	{
    		$pdf->Write(6, 'Sehr geehrte Damen und Herren, entsprechend Ihrer Bestellung vom '.date("d.m.Y",$time).' stellen wir folgende Leistungen in Rechnung:');
	}


    $pdf->Ln(10);


// -------  items  ---------

    // Colors, line width and bold font
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.1);
    $pdf->SetFont('','B',8);
    // Header
    $w = array(10, 105, 20, 15,20);
    $header = array('Pos.', 'Bezeichnung', 'Preis/Stk', 'Stk', 'Preis gesamt');

    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);

    $pdf->Ln();
    
    // Color and font restoration
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('','',8);
    
    // Data
    $fill = false;

    $pdf->SetWidths($w);
    $n=0;


if($orders->Override_TotalInvoice=="")
{
     foreach ($orders_item as $order_item)
      {
       $n++;


$empf_Str="";

$text_Str="";
if($order_item->is_batch2!='0')
{
	$empf_Str="\n".UTFencoder2("Empfänger: ").UTFencoder2($order_item->firstname)." ".UTFencoder2($order_item->lastname);
}


if($order_item->text!='')
{
	$text_Str="\n".UTFencoder2($order_item->text);
}

if($order_item->ItemType=='10')
{

$text_Str .= " " . UTFencoder2($order_item->ShownName);

}

	$ribbon_type = show_ribbon_images($order_item->type, $order_item->batch_image, $order_item->number, $order_item->country,$order_item->id);
        $imagepath=str_replace('<div class="ribbon_outer"><img src="','',$ribbon_type);
    	$imagepath=str_replace('" class="img-responsive"></div>','',$imagepath);


         $pdf->Row(
array(str_pad ($n,5,' ',STR_PAD_LEFT),
UTFencoder2($order_item->batch_name).$text_Str.$empf_Str,str_pad (number_format($order_item->unit_price,2,",",".") ,12,' ',STR_PAD_LEFT),str_pad (number_format($order_item->quantity,2,",","."),8,' ',STR_PAD_LEFT),str_pad (number_format($order_item->unit_price * $order_item->quantity,2,",","."),12,' ',STR_PAD_LEFT)));



     }

}
else
{
$pdf->Row(array(str_pad (1,5,' ',STR_PAD_LEFT),$orders->Override_TotalInvoice,number_format($orders->grand_total,2,",","."),"1",number_format($orders->grand_total,2,",",".")));
}


$totalincludingVAT=$orders->grand_total;
$totalincludingVATandShipment=$orders->grand_total*(1-$Discount)+$ShippingCosts;
$totalexcludingVATandShipment=($orders->grand_total*(1-$Discount)+$ShippingCosts)/1.2;
$totalVATandShipment=$totalexcludingVATandShipment*0.2;

$totalincludingVATandShipmentandCreditnote=$totalincludingVATandShipment-$orders->creditnote;
$totalexcludingVATandShipmentandCreditnote=$totalincludingVATandShipmentandCreditnote/1.2;
$totalVATandShipmentandCreditnote=$totalexcludingVATandShipmentandCreditnote*0.2;
$downpaymentDone=$totalincludingVATandShipment*$orders->downpayment/100;
$totalafterDownpaymentinclVAT=$totalincludingVATandShipmentandCreditnote-$downpaymentDone;
$totalafterDownpaymentexclVAT=$totalafterDownpaymentinclVAT/1.2;
$totalafterDownpaymentVAT=$totalafterDownpaymentexclVAT*0.2;


        $pdf->Cell($w[0],6,'','LTB',0);
        $pdf->Cell($w[1],6,'Summe inkl. USt','TB',0);
        $pdf->Cell($w[2],6,'','TB',0);
        $pdf->Cell($w[3],6,'EUR','TB',0);
        $pdf->Cell($w[4],6,str_pad (number_format($orders->grand_total,2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');

if ($orders->discount==0.2)
{
        $pdf->SetFont('','B');
        $pdf->Cell($w[0],6,'','LTB',0);
        $pdf->Cell($w[1],6,'Aktionspreis 20% rabattiert','TB',0);
        $pdf->Cell($w[2],6,'','TB',0);
        $pdf->Cell($w[3],6,'EUR','TB',0);
        $pdf->Cell($w[4],6,str_pad (number_format($orders->grand_total*(1-$Discount),2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');
}
if ($orders->discount==0.07)
{
        $pdf->SetFont('','B');
        $pdf->Cell($w[0],6,'','LTB',0);
        $pdf->Cell($w[1],6,'Aktionspreis 7% rabattiert','TB',0);
        $pdf->Cell($w[2],6,'','TB',0);
        $pdf->Cell($w[3],6,'EUR','TB',0);
        $pdf->Cell($w[4],6,str_pad (number_format($orders->grand_total*(1-$Discount),2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');
}
if ($orders->discount==0.1)
{
        $pdf->SetFont('','B');
        $pdf->Cell($w[0],6,'','LTB',0);
        $pdf->Cell($w[1],6,'Aktionspreis 10% rabattiert','TB',0);
        $pdf->Cell($w[2],6,'','TB',0);
        $pdf->Cell($w[3],6,'EUR','TB',0);
        $pdf->Cell($w[4],6,str_pad (number_format($orders->grand_total*(1-$Discount),2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');
}

if ($orders->discount==1)
{
        $pdf->SetFont('','B');
        $pdf->Cell($w[0],6,'','LTB',0);
        $pdf->Cell($w[1],6,'Kostenloses Liefermuster','TB',0);
        $pdf->Cell($w[2],6,'','TB',0);
        $pdf->Cell($w[3],6,'EUR','TB',0);
        $pdf->Cell($w[4],6,str_pad (number_format($orders->grand_total*(1-$Discount),2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');
}



        $pdf->SetFont('','');
        $pdf->Cell($w[0],6,'','LTB',0);
        $pdf->Cell($w[1],6,'Versandkosten','TB',0);
        $pdf->Cell($w[2],6,'','TB',0);
        $pdf->Cell($w[3],6,'EUR','TB',0);
        $pdf->Cell($w[4],6,str_pad (number_format($ShippingCosts,2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');


        $pdf->SetFont('','B');
        $pdf->Cell($w[0],8,'','LTB',0);
        $pdf->Cell($w[1],8,'Gesamtsumme mit Versand inkl. USt','TB',0);
        $pdf->Cell($w[2],8,'','TB',0);
        $pdf->Cell($w[3],8,'EUR','TB',0);
        $pdf->Cell($w[4],8,str_pad (number_format($totalincludingVATandShipment,2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');


        $pdf->SetFont('','');
        $pdf->Cell($w[0],6,'','LTB',0);
        $pdf->Cell($w[1],6,'davon Summe exkl. USt','TB',0);
        $pdf->Cell($w[2],6,'','TB',0);
        $pdf->Cell($w[3],6,'EUR','TB',0);
        $pdf->Cell($w[4],6,str_pad (number_format($totalexcludingVATandShipment,2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');
        

        $pdf->Cell($w[0],6,'','LTB',0);
        $pdf->Cell($w[1],6,'davon USt 20% ','TB',0);
        $pdf->Cell($w[2],6,'','TB',0);
        $pdf->Cell($w[3],6,'EUR','TB',0);
        $pdf->Cell($w[4],6,str_pad (number_format($totalVATandShipment,2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');


if ($orders->creditnote!=0)
{
         $pdf->SetFont('','B');
       $pdf->Cell($w[0],8,'','LTB',0);
        $pdf->Cell($w[1],8,'Gutschrift','TB',0);
        $pdf->Cell($w[2],8,'','TB',0);
        $pdf->Cell($w[3],8,'EUR','TB',0);
        $pdf->Cell($w[4],8,str_pad (number_format($orders->creditnote,2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');
}

    
if ($orders->downpayment!=0)
{
        $pdf->SetFont('','B');
        $pdf->Cell($w[0],8,'','LTB',0);
        $pdf->Cell($w[1],8,'Geleistete Anzahlung '.$orders->downpayment.'%','TB',0);
        $pdf->Cell($w[2],8,'','TB',0);
        $pdf->Cell($w[3],8,'EUR','TB',0);
        $pdf->Cell($w[4],8,str_pad (number_format((($orders->grand_total*(1-$Discount)+$ShippingCosts)*$orders->downpayment/100),2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');


        $pdf->SetFont('','B');
        $pdf->Cell($w[0],8,'','LTB',0);
        $pdf->Cell($w[1],8,'Gesamtsumme noch offen','TB',0);
        $pdf->Cell($w[2],8,'','TB',0);
        $pdf->Cell($w[3],8,'EUR','TB',0);
        $pdf->Cell($w[4],8,str_pad (number_format($totalafterDownpaymentinclVAT,2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');

        $pdf->SetFont('','');
        $pdf->Cell($w[0],6,'','LTB',0);
        $pdf->Cell($w[1],6,'davon Summe exkl. USt','TB',0);
        $pdf->Cell($w[2],6,'','TB',0);
        $pdf->Cell($w[3],6,'EUR','TB',0);
        $pdf->Cell($w[4],6,str_pad (number_format($totalafterDownpaymentexclVAT,2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');
        
        $pdf->Cell($w[0],6,'','LTB',0);
        $pdf->Cell($w[1],6,'davon USt 20% ','TB',0);
        $pdf->Cell($w[2],6,'','TB',0);
        $pdf->Cell($w[3],6,'EUR','TB',0);
        $pdf->Cell($w[4],6,str_pad (number_format($totalafterDownpaymentVAT,2,",","."),12,' ',STR_PAD_LEFT),'TBR',1,'L');
}



        $pdf->SetFont('','',10);
        $pdf->Cell(0,3,UTFencoder2(''),0,1);

    $shipping_string =SHIPPING_TIME_TITLE . ": " . SHIPPING_TIME_VALUE;

        if ($orders->is_payment_made == 1) 
        {
            if($orders->payment_method_name=="Paypal")
            {
            $pdf->Cell(0,8,UTFencoder2('Betrag am '.date("d.m.Y",$time) .' per PayPal vollständig bezahlt.'),0,1);
            }
            elseif($orders->payment_method_name=="Sofort")
            {
             $pdf->Cell(0,8,UTFencoder2('Betrag am '.date("d.m.Y",$time) .' per Sofortüberweisung vollständig bezahlt.'),0,1);                           
            }
        }

        if ($orders->is_payment_made == 0) 
        {
            
            if($orders->payment_method_name=="Paypal")
            {
                $pdf->Cell(0,2,UTFencoder2('Ihre gewählte Zahlmethode PayPal schlug fehl und wurde automatisch auf Vorauskassa geändert.'),0,1);
            }
            elseif($orders->payment_method_name=="Sofort")
            {
                $pdf->Cell(0,2,UTFencoder2('Ihre gewählte Zahlmethode Sofortüberweisung schlug fehl und wurde automatisch auf Vorauskassa geändert.'),0,1);
            }
            elseif($orders->payment_method_name=="onaccount")
            {
                $pdf->Cell(0,2,UTFencoder2('Zahlungsmethode: Rechnung; Zahlungsziel ' . $paymentcondition->name_dr),0,1);
            }
            else
            {
               $pdf->Cell(0,2,UTFencoder2('Zahlungsmethode: Vorauskasse'),0,1);
                
            }

            $pdf->Cell(0,8,UTFencoder2('Bitte überweisen Sie den gesamten Betrag von EUR '.number_format($totalafterDownpaymentinclVAT,2,",",".") .' auf untenstehendes Konto.'),0,1);
        }

    $deltime=strtotime($orders->estimate_delivery_date);


        $pdf->Cell(0,5,UTFencoder2(''),0,1);



if (get_discount_string_admin($orders->billing_zip)<>"")
{

	if($orders->override_delivery_date!="")
	{

		       $pdf->Cell(0,8,$orders->override_delivery_date,0,1);


	}
	else
	{
 	        if($orders->payment_method_name=="onaccount")
		{
	   	     $pdf->Cell(0,8,"Versanddatum: 5 Werktage ab Bestelldatum",0,1);
		}
		else
		{
		       $pdf->Cell(0,8,$shipping_string,0,1);
		}
	}

}
else
{
	if($orders->override_delivery_date!="")
	{

		       $pdf->Cell(0,8,$orders->override_delivery_date,0,1);


	}
	else
	{
 	        if($orders->payment_method_name=="onaccount")
		{
	   	     $pdf->Cell(0,8,"Versanddatum: 5 Werktage ab Bestelldatum",0,1);
		}
		else
		{
		       $pdf->Cell(0,8,$shipping_string,0,1);
		}
	}
}


        $pdf->Cell(0,5,UTFencoder2(''),0,1);

       //if ($orders->order_comment <> "") 
       //{
       //    $pdf->SetFont('','I');
       //     $pdf->MultiCell(0,6,UTFencoder2("Folgende Anmerkungen wurden Ihrer Bestellung angefügt:\n").UTFencoder2($orders->order_comment),1,1);
       //     $pdf->SetFont('','');
       //}


        $pdf->Cell(0,4,UTFencoder2(''),0,1);
  //      $pdf->Cell(0,8,UTFencoder2('Wir würden uns sehr freuen, wenn Ihnen unser Angebot zusagt,'),0,1);
  //      $pdf->Cell(0,8,UTFencoder2('Danke für Ihren Auftrag,'),0,1);
        $pdf->Cell(0,8,UTFencoder2('Mit besten Grüßen'),0,1);

        $pdf->Image('signature.jpg',null,null,50);
        $pdf->Cell(0,8,'Mag. Florian Hell',0,1);

        if (!file_exists('../ad-min/pdfAblage/'.$orders->id)) {
  	  mkdir('../ad-min/pdfAblage/'.$orders->id, 0777, true);
	}

    $pdf->Output('F', '../ad-min/pdfAblage/'.$orders->id.'/'.'Rechnung AR-W-1'.str_pad ($orders->id,5,'0',STR_PAD_LEFT).'('.date("d.m.Y").').pdf');
    $pdf->Output('', 'Rechnung AR-W-1'.str_pad ($orders->id,5,'0',STR_PAD_LEFT).'.pdf');


?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script>

