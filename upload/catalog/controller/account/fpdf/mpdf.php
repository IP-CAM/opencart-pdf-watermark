<?php
require_once('fpdf.php');
require_once('fpdi.php');

$pdf = new FPDI();

$docs = DIR_DOWNLOAD;	
$download_info = $this->model_account_download->getDownload($order_download_id);	
$nume = $download_info['mask'];
$customfname = ucfirst($download_info['firstname']);
$customlname = ucfirst($download_info['lastname']);
$customemail = $download_info['email'];
$customtel = $download_info['telephone'];	

$num = md5($nume);
$pagecount = $pdf->setSourceFile($docs.basename($file));
$azi = date("d-M-Y");

$pdf->addPage('P');

for ($n = 1; $n <= $pagecount; $n++) {
    $tplidx = $pdf->ImportPage($n);

    $size = $pdf->useTemplate($tplidx);
     
	$pdf->SetFont('Arial', '', 10); 
	    $pdf->SetTextColor(255, 0, 0); 
		$pdf->SetX(5); 
		$pdf->Write(0, "Customer: ".$customfname." ".$customlname." E-mail: ".$customemail." Telephone: ".$customtel);  
		
	$pdf->SetFont('Arial', '', 10); 
	   $pdf->SetTextColor(25500, 0, 0); 
		$pdf->SetY(276.5); 
		$pdf->Write(0, "Generated: on: ".$azi." -> ".md5($nume)); 

       if($n < $pagecount) $pdf->AddPage();  

}

$pdf->Output(basename($download_info['mask']), 'D');
$this->model_account_download->updateRemaining($this->request->get['order_download_id']);
?>