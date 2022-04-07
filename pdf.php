<?php
 function add_watermark($file, $x_axis, $y_axis, $op, $outdir) 
 {
    
    require_once('vendor/autoload.php');
     $pdf =  new \setasign\Fpdi\Fpdi();
    
     if (file_exists($file)){
         $pagecount = $pdf->setSourceFile($file);
        
     } else {
        return FALSE;
     }
     $tpl = $pdf->importPage(1);
     $pdf->addPage();
     $size = $pdf->getTemplateSize($tpl);
     
     $pdf->useTemplate($tpl, null, null, $size['width'], $size['height'], TRUE);
     $data=$pdf->Image('dsignature.png', $x_axis, $y_axis, 0, 20, 'png');
     
     $save_file_name = 'uploads/'.time().'.pdf';

     if ($outdir === TRUE){
        $pdf->Output($save_file_name, 'F');
        
     } else {
         return $pdf;
     }
     
 }
// 


echo add_watermark("ProformaInvoice.pdf", 160, 200, 90,TRUE);
 
?>