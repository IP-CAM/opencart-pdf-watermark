<?php
define('FPDF_FONTPATH','font/');
require('fpdi.php');

$pdf= new fpdi('P', 'pt', 'Letter');
$pagecount = $pdf->setSourceFile("demo.pdf");

$tplidx = $pdf->ImportPage(1);

$pdf->addPage();
$pdf->useTemplate($tplidx, 0, 0);

$pdf->SetFont('Arial','',14);

$pdf->SetXY(72, 36);
$pdf->write(10, "Some Sample Text");

$pdf->SetXY(72, 72);
$pdf->write(10, "Some More Sample Text");

$pdf->SetXY(72, 108);
$pdf->write(10, "... and another line");

$pdf->Output("newpdf.pdf","I");
?>
