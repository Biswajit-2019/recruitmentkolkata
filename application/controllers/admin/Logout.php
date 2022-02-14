<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

public function __construct()  
    {
		parent::__construct();	 
		$this->load->model(array('Admin_model'));	
		
	}

	public function index()
	{
		//$this->load->view('admin/includes/header');
		
		$this->session->sess_destroy();
		redirect('admin');
		
		//$this->load->view('admin/includes/footer');
	}
}
