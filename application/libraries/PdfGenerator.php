<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
require_once './vendor/dompdf/autoload.inc.php';
class PdfGenerator
{
    public function generate($html, $filename)
    {
        $ci =& get_instance();
        $dompdf = new Dompdf();
    	$dompdf->setPaper($ci->config->item('pdf_paper'), $ci->config->item('pdf_orientation')[$filename]);
    	$dompdf->set_option('isRemoteEnabled', true);
        $dompdf->set_option('defaultFont', $ci->config->item('font_pdf'));
        $dompdf->loadHtml($html);
        $dompdf->render();
        // $dompdf->stream();
        $dompdf->stream($filename.' '.date('Y-m-d'), array('Attachment'=>$ci->config->item('pdf_download')));
    }
}