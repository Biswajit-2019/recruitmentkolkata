<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagline extends CI_Controller {

public function __construct()  
    {
		parent::__construct();	 
		$this->load->model(array('Admin_model'));	
		
	}

	public function index()
	{
		if($this->session->userdata('user_id'))
		{
			
			
			$data['single'] = $this->Admin_model->getData('tagline', array('id' => 1));
			
			$this->load->view('admin/includes/header');
			$this->load->view('admin/tagline-listing',$data);
			$this->load->view('admin/includes/footer');
		}
		else
		{
			redirect('admin');
		}
	}

	
	public function edit()
	{
		if($this->session->userdata('user_id'))
		{

			if($this->input->post('id'))
			{
					$id = $this->input->post('id');
				  $this->Admin_model->updateValue(array('tagline_text' => $this->input->post('metadesc')),'tagline',array('id' => $id ));
					redirect('admin/tagline');
			}
			else
			{
					$id = $this->uri->segment(4);
					$data['single'] = $this->Admin_model->getData('tagline', array('id' => $id ));
					$this->load->view('admin/includes/header');
					$this->load->view('admin/edit_tagline',$data);
					$this->load->view('admin/includes/footer');
			}

			
		}
		else
		{
			redirect('admin');
		}
		
	}
	
	
}
