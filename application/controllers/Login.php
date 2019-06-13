<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
		//$this->load->library('session');

	}
	public function index()
	{
		$this->load->view('plantillas/headers_inicio');
		$this->load->view('inicio');
		$this->load->view('plantillas/footer');
	}
	public function registrarse()
	{
		$this->load->view('plantillas/headers');
		$this->load->view('registro');
		$this->load->view('plantillas/footer_registrologin');
	}

	public function ingresando()
	{
		$this->load->view('plantillas/headers');
		$this->load->view('ingreso');
		$this->load->view('plantillas/footer_registrologin');
	}
	//Controlador responsable de efectuar el registro de un nuevo usuario
	private function _registro()
	{
		//Empaquetamiento de usuarios
		$datos = [
			'nombre' =>$_POST['nombre'],
			'correo' =>$_POST['email'],
			'usuario' =>$_POST['usuario'],
			'password' =>$_POST['password']
		];
		//Llamando al modelo de los usuarios
		$this->load->model('Usuario');
		//Se recibirá la respuesta desde el modelo
		$retorno = $this->Usuario->nuevo_usuario($datos);
		if(!headers_sent()) 
        {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: ' . date('r'));
            header('Content-type: application/json');
		} 
		$response=['respuesta' => $retorno];
		exit(json_encode($response,JSON_FORCE_OBJECT));
	}

	public function registro()
	{
		return $this->_registro();
	}

	private function _ingreso()
	{
		//Validación única: usuario y/o contraseña no deben estar vacíos
		if($_POST['user'] == '' || $_POST['pass'] == '')
			{
				header('Location: '.base_url().'index.php/ingresar');
				echo 'Usuario y/o contraseña deben ser completados';
				
			}
		else 
		{
			//Recolección de datos
			$datos['usuario'] = $_POST['user'];
			$datos['password'] = $_POST['pass'];
			$datos['token2'] = $_POST['_token_'];
			//Carga de modelo
			$this->load->model('Usuario');
			$retorno = $this->Usuario->ingreso_usuario($datos);
			if(!$retorno)
				header('Location: '.base_url().'index.php/ingresar');
			else 
				header('Location: '.base_url().'index.php/main');
		}
	}

	public function ingreso()
	{
		return $this->_ingreso();
	}
}
