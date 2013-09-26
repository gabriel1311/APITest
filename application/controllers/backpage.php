<?php if (!defined('BASEPATH')) die();

class Backpage extends CI_Controller{
	
	public function index(){
		$this->load->view('frontpage');
	}

	
}