<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

public function __construct()  
    {
		parent::__construct();	 
		$this->load->model(array('Admin_model'));	
		
	}

	public function index()
	{

		if($this->session->userdata('user_id'))
		{
		$this->load->view('admin/includes/function');	
		$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
		$limit = 5;
		$startpoint = ($page * $limit) - $limit;
		$statement = "`banner`";
		$data['cms'] =$this->Admin_model->getAll('banner',$param='',$order_by_fld='',$order_by='',$limit,$startpoint);
		$Num=$this->Admin_model->getCounts("SELECT COUNT(*) as `num` FROM {$statement}");
		$data['num']=$Num[0]->num;
		$data['limit'] = $limit;
		$data['startpoint'] = $startpoint;
		$data['statement'] = $statement;
		$data['page'] = $page;

		$this->load->view('admin/includes/header');
		$this->load->view('admin/banner',$data);
		$this->load->view('admin/includes/footer');
		}
		else
		{
			redirect('admin');
		}
	}
	public function add_banner()
	{
		if($this->session->userdata('user_id'))
		{

		if($this->input->post('add_banner'))
		{
			$config['upload_path'] = './public/uploaded/banner';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$this->load->library('upload', $config);
			//print_r($this->input->post()); die();
			if($this->upload->do_upload('fileup'))
				{
					$image_detail = $this->upload->data();
					
					$file_name = $image_detail['file_name'];	
					$param=array('title'=>$this->input->post('title'),'text'=>$this->input->post('content'),
					'images'=>base_url().'public/uploaded/banner/'.$file_name,'status'=>'Y');
					$this->Admin_model->insertData('banner',$param);
					$this->session->set_flashdata('success', 'Banner Added Successfully');
					redirect('admin/banner');
				}
				else
				{
					redirect('admin/banner');
				}
		}
		else
		{
			$this->load->view('admin/includes/header');
			$this->load->view('admin/add-banner');
			$this->load->view('admin/includes/footer');
		}

		} // If Ends Here
		else
		{
			redirect('admin');
		}
	}

	public function delete()
	{
		if($this->session->userdata('user_id'))
		{
		if($this->input->get('id'))
		{
			$data=$this->Admin_model->getData('banner',array('id'=>$this->input->get('id')));
			
			@unlink(str_replace(base_url(),'./',$data[0]->images));
			
			$this->Admin_model->deleteData('banner',array('id'=>$this->input->get('id')));
			$this->session->set_flashdata('success', 'Banner Deleted Successfully');
			redirect('admin/banner');
		}
		}
		else
		{
			redirect('admin/banner');
		}
		
	}

	public function edit()
	{
		if($this->session->userdata('user_id'))
		{
			if($this->input->get('id'))
			{
				$data['banner']=$this->Admin_model->getData('banner',array('id'=>$this->input->get('id'),'status'=>'Y'));
				$this->load->view('admin/includes/header');
				$this->load->view('admin/update-banner',$data);
				$this->load->view('admin/includes/footer');
			}
			else
			{
				if($this->input->post('add_banner'))
			{
			$config['upload_path'] = './public/uploaded/banner';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$this->load->library('upload', $config);
			//echo $_SERVER["DOCUMENT_ROOT"];
			/*echo str_replace(base_url(),'',$this->input->post('images'));
			unlink(str_replace(base_url(),'',$this->input->post('images')));

			 die();*/
			if($this->upload->do_upload('fileup'))
				{
					@unlink(str_replace(base_url(),'./',$this->input->post('images')));
					$image_detail = $this->upload->data();
					
					$file_name = $image_detail['file_name'];	
					$param=array('title'=>$this->input->post('title'),'text'=>$this->input->post('content'),
					'images'=>base_url().'public/uploaded/banner/'.$file_name,'status'=>'Y');
					$this->Admin_model->updateValue($param,'banner',array('id'=>$this->input->post('id')));
					$this->session->set_flashdata('success', 'Banner Updated Successfully');
					redirect('admin/banner');
				}
				else
				{

					$param=array('title'=>$this->input->post('title'),'text'=>$this->input->post('content'),
					'status'=>'Y');
					$this->Admin_model->updateValue($param,'banner',array('id'=>$this->input->post('id')));
					$this->session->set_flashdata('success', 'Banner Updated Successfully');
					redirect('admin/banner');
				}
			}

			else
			{
				redirect('admin/banner');
			}


			}
		}	
		else
		{
			redirect('admin');
		}
		
	}
}
