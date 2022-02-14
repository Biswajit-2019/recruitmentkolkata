<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

public function __construct()  
    {
		parent::__construct();	 
		$this->load->model(array('Admin_model'));	
		
	}

	public function index()
	{
		//$this->load->view('admin/includes/header');

		if(base64_decode($this->input->get('token')) == adminToken || $this->session->userdata('admin_token') == 'yes')
		{
			$this->session->set_userdata('admin_token', 'yes');
			
		}
		else
		{
			show_404();
		}
		
		
		if($this->input->post('sub'))
		{
			
			$this->session->set_flashdata('item', 'value');
			$param=array('user_name'=>$this->input->post('username'),'password'=>md5($this->input->post('pass')),'status'=>'Y');
			
			if($this->Admin_model->getNumrows('backend_users',$param)>0)
			{
				$data=$this->Admin_model->getData('backend_users',$param);
				$this->session->set_userdata('user_id', $data[0]->id);
				$this->session->userdata('user_id');
				redirect('admin/hindi/dashboard');
			}
			else
			{
				$this->session->set_flashdata('error', 'Invalid user name or password');
				redirect('admin/hindi/home');
			}
		}
		else
		{
			if($this->session->userdata('user_id'))
			{
				redirect('admin/hindi/dashboard');
			}
			else
			{
				$this->load->view('admin/hindi/home');
			}
			
		}
		
		//$this->load->view('admin/includes/footer');
	}
}
