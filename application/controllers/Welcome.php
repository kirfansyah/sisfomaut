<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

    public function assets_zip()
    {
        $this->zip->read_file('assets/files/1.txt');
        $this->zip->read_file('assets/files/2.txt');
        $this->zip->read_file('assets/files/3.txt');

        $download_filename = 'assets_zip_'.date('Ymd_His').'.zip';
        $this->zip->download($download_filename);
    }
}
