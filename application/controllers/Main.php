<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller 
{
    public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');

	}
    public function index()
	{
		$this->load->view('plantillas/headers_main');
		$this->load->view('sistema/main');
		$this->load->view('plantillas/footer_main');
	}

	public function salirSistema()
	{
		//Eliminando la credencial
		$this->session->unset_userdata('user_data');
		redirect('/');
	}
} 