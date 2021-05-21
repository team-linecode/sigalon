<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * CodeIgniter DomPDF Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge        CodeIgniter
 * @subpackage        Libraries
 * @category        Libraries
 * @author        Ardianta Pargo
 * @license        MIT License
 * @link        https://github.com/ardianta/codeigniter-dompdf
 */

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
	/**
	 * PDF filename
	 * @var String
	 */
	public $filename;
	public function __construct()
	{
		parent::__construct();
		$this->filename = "invoice.pdf";
	}
	/**
	 * Load a CodeIgniter view into domPDF
	 *
	 * @access    public
	 * @param    string    $view The view to load
	 * @param    array    $data The view data
	 * @return    void
	 */
	public function load_view($view, $data = [])
	{
		$ci = get_instance();
		$html = $ci->load->view($view, $data, TRUE);
		$this->loadHtml($html);
		$this->render();
		$this->stream($this->filename, ["Attachment" => false]);
	}
}
