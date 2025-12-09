<?php
require('/../../../MakePDF/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.jpg',20,15,180);
    // Arial bold 15
 //   $this->SetFont('Arial','B',15);
    // Move to the right
 //   $this->Cell(80);
    // Title
  //  $this->Cell(30,10,'Title',1,0,'C');
    // Line break
    $this->Ln(40);
}

function UserAddress()
{
    $this->SetFont('Times','',12);
   $this->Cell(0,10,'Max Mustermann '.'',0,1);
   $this->Cell(0,10,'Musterstrasse 10 '.'',0,1);
   $this->Cell(0,10,'1234 Musterort '.'',0,1);
    $this->Ln(30);
}

function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}


function Table($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(230,230,230);
    $this->SetTextColor(0);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(20, 60, 40, 30,40);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Cell($w[4],6,number_format($row[4]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetFont('','B');
$pdf->UserAddress();
$pdf->Cell(0,10,'Rechnung Nummer '.'351',0,1);

for($i=1;$i<=2;$i++)
    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$header = array('Nr.', 'Bezeichnung', 'Preis/Stk', 'Stk', 'Preis gesamt');
$data = $pdf->LoadData('http://www.ausgezeichnet.cc/MakePDF/countries.txt');
$pdf->Table($header,$data);

$pdf->Output();
?>