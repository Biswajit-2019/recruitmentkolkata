<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

public function __construct()  
    {
		parent::__construct();	 
		$this->load->model(array('Admin_model'));	
		
	}

	public function index()
	{
		//$this->load->view('admin/includes/header');
		
		if($this->session->userdata('user_id'))
		{
			$this->load->view('admin/hindi/includes/header');
			$this->load->view('admin/hindi/dash-view');
			$this->load->view('admin/hindi/includes/footer');
		}
		else
		{
			$this->load->view('admin/hindi/home');
		}
		
		//$this->load->view('admin/includes/footer');
	}
}
