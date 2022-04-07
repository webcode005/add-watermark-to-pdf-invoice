<?php
 function add_watermark($file, $x_axis, $y_axis, $op, $outdir) 
 {
     require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');
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
     $data=$pdf->Image('custom.png', $x_axis, $y_axis, 0, 20, 'png');
     
     if ($outdir === TRUE){
        $pdf->Output();
        
     } else {
         return $pdf;
     }
     
 }
//  
 
if(count($_POST)>0 && !empty($_POST['title']) && !empty($_POST['genrate_pdf']))
{

$text = $_POST['title'];
$my_img = imagecreate( 500, 80 );                             //width & height
$background  = imagecolorallocate( $my_img, 240,   79,   83 );
$text_colour = imagecolorallocate( $my_img, 0, 0, 0 );
$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
imagestring( $my_img, 4, 30, 25, $text, $text_colour );
imagesetthickness ( $my_img, 5 );
imageline( $my_img, 30, 45, 165, 45, $line_colour );
header( "Content-type: image/png" );
imagepng( $my_img,'custom.png');
add_watermark("example12456.pdf", 80, 80, 90,TRUE);
}
?>