﻿<?php
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
		 $this->session->userdata('user_id');
		//print_r($_SESSION);die();
		
		if($this->session->userdata('user_id'))
		{
			
			$this->load->view('admin/includes/header');
			$this->load->view('admin/dash-view');
			$this->load->view('admin/includes/footer');
	
		}
		else
		{
			$this->load->view('admin/home');
		}
		
		//$this->load->view('admin/includes/footer');
	}
}
