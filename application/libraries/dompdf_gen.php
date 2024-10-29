<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Name:  DOMPDF
 *
 * Author: Jd Fiscus
 *            jdfiscus@gmail.com
 *         @iamfiscus
 *
 * Origin API Class: http://code.google.com/p/dompdf/
 *
 * Location: http://github.com/iamfiscus/Codeigniter-DOMPDF/
 *
 * Created:  06.22.2010
 *
 * Description:  This is a Codeigniter library which allows you to convert HTML to PDF with the DOMPDF library
 *
 */

class Dompdf_gen
{
    public function __construct()
    {
        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

        // Create a new instance of Dompdf
        $pdf = new Dompdf();

        // Set options
        $options = new Options();
        $options->set('isRemoteEnabled', true); 

        $pdf->setOptions($options);

        // Assign the Dompdf instance to the CI instance
        $CI = &get_instance();
        $CI->dompdf = $pdf;
    }
}
