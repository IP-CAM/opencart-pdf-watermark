<?php		
	
	$docs = DIR_DOWNLOAD;	
	$download_info = $this->model_account_download->getDownload($order_download_id);
	

	$this->$nume = $download_info['mask'];
	$this->$customfname = $download_info['firstname'];
	$this->$customlname = $download_info['lastname'];
	$this->$customemail= $download_info['email'];
	$this->$customtel = $download_info['telephone'];				
class concat_pdf extends FPDI {	
    var $files = array();

    function setFiles($files) {
        $this->files = $files;
    }
	function Header() {

		$this->SetFont('Arial', 'B', 10); 
	    $this->SetTextColor(155); 
        $this->SetXY(10, 10); 
		$this->Cell(0, 5, "OKK"); 
	
	}

	function concat() {
	$docs = DIR_DOWNLOAD;	
        foreach($this->files AS $file) {
            $pagecount = $this->setSourceFile($file);
            for ($i = 1; $i <= $pagecount; $i++) {
                 $tplidx = $this->ImportPage($i);
                 $s = $this->getTemplatesize($tplidx);
                 $this->AddPage('P', array($s['w'], $s['h']));
                 $this->useTemplate($tplidx);
            }
        }
    }
	function Footer() {
		$this->SetFont('Arial', 'B', 10); 
	    $this->SetTextColor(100); 
		$this->SetXY(10, 300); 
		$this->Cell(-10, -20, "Nicu DICA - Footer"); 
	} 		
	}		
$pdf =& new concat_pdf();
$pdf->setFiles(array($docs.basename($file)));

$pdf->Header();
$pdf->concat();
$pdf->Footer();

$pdf->Output('newpdf.pdf', 'D');
$this->model_account_download->updateRemaining($this->request->get['order_download_id']);

?>