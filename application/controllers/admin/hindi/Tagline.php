<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagline extends CI_Controller {

public function __construct()  
    {
		parent::__construct();	 
		$this->load->model(array('Hindi_admin_model'));	
		
	}

	public function index()
	{
		if($this->session->userdata('user_id'))
		{
			
			
			$data['single'] = $this->Hindi_admin_model->getData('tagline', array('id' => 2));
			
			$this->load->view('admin/hindi/includes/header');
			$this->load->view('admin/hindi/tagline-listing',$data);
			$this->load->view('admin/hindi/includes/footer');
		}
		else
		{
			redirect('admin/hindi');
		}
	}

	
	public function edit()
	{
		if($this->session->userdata('user_id'))
		{

			if($this->input->post('id'))
			{
					$id = $this->input->post('id');
				  $this->Hindi_admin_model->updateValue(array('tagline_text' => $this->input->post('metadesc')),'tagline',array('id' => $id ));
					redirect('admin/hindi/tagline');
			}
			else
			{
					$id = $this->uri->segment(5);
					$data['single'] = $this->Hindi_admin_model->getData('tagline', array('id' => $id ));
					$this->load->view('admin/hindi/includes/header');
					$this->load->view('admin/hindi/edit_tagline',$data);
					$this->load->view('admin/hindi/includes/footer');
			}

			
		}
		else
		{
			redirect('admin/hindi');
		}
		
	}
	
	
}
