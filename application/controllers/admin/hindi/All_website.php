<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_website extends CI_Controller {

public function __construct()  
    {
		parent::__construct();	 
		$this->load->model(array('Hindi_admin_model'));	
		
	}

	public function index()
	{

		if($this->session->userdata('user_id'))
		{
		$this->load->view('admin/hindi/includes/function');	
		$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
		$limit = 5;
		$startpoint = ($page * $limit) - $limit;
		$statement = "`hindi_websites`";
		$param=array('status'=>'Y');
		$data['cms'] =$this->Hindi_admin_model->getAll('hindi_websites',$param,$order_by_fld='',$order_by='',$limit,$startpoint);
		$Num=$this->Hindi_admin_model->getCounts("SELECT COUNT(*) as `num` FROM {$statement}");
		$data['num']=$Num[0]->num;
		$data['limit'] = $limit;
		$data['startpoint'] = $startpoint;
		$data['statement'] = $statement;
		$data['page'] = $page;

		$this->load->view('admin/hindi/includes/header');
		$this->load->view('admin/hindi/all-website',$data);
		$this->load->view('admin/hindi/includes/footer');
		}
		else
		{
			redirect('admin');
		}
	}
	public function add_website()
	{
		if($this->session->userdata('user_id'))
		{

		if($this->input->post('add_banner'))
		{
			
			$config['upload_path'] = './public/uploaded/icon';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$this->load->library('upload', $config);
			//print_r($this->input->post()); die();
			if($this->upload->do_upload('fileup'))
				{
					$image_detail = $this->upload->data();
					
					$file_name = $image_detail['file_name'];

					$param=array('web_title'=>$this->input->post('title'),'link'=>$this->input->post('link'),
					'class'=>$this->input->post('webclass'),'icon'=>base_url().'public/uploaded/icon/'.$file_name,'status'=>'Y');
					$this->Hindi_admin_model->insertData('hindi_websites',$param);
					$this->session->set_flashdata('success', 'Websites Added Successfully');
					redirect('admin/hindi/all-website');
				}
				else
				{
					$param=array('web_title'=>$this->input->post('title'),'link'=>$this->input->post('link'),
					'class'=>$this->input->post('webclass'),'status'=>'Y');
					$this->Hindi_admin_model->insertData('hindi_websites',$param);
					$this->session->set_flashdata('success', 'Websites Added Successfully');
					redirect('admin/hindi/all-website');
				}

			
				
		}
		else
		{
			$this->load->view('admin/hindi/includes/header');
			$this->load->view('admin/hindi/add-website');
			$this->load->view('admin/hindi/includes/footer');
		}

		} // If Ends Here
		else
		{
			redirect('admin/hindi/dashboard');
		}
	}

	public function update_website()
	{
		if($this->session->userdata('user_id'))
		{

		if($this->input->post('update_website'))
		{
			


			$config['upload_path'] = './public/uploaded/icon';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$this->load->library('upload', $config);
			//print_r($this->input->post()); die();
			if($this->upload->do_upload('fileup'))
				{
					$image_detail = $this->upload->data();
					
					$file_name = $image_detail['file_name'];

					$param=array('web_title'=>$this->input->post('title'),'link'=>$this->input->post('link'),
					'class'=>$this->input->post('webclass'),'icon'=>base_url().'public/uploaded/icon/'.$file_name,'status'=>'Y');
					$this->Hindi_admin_model->updateValue($param,'hindi_websites',array('id'=>$this->input->post('id')));
					$this->session->set_flashdata('success', 'Websites Updated Successfully');
					redirect('admin/hindi/all-website');
				}
				else
				{
					$param=array('web_title'=>$this->input->post('title'),'link'=>$this->input->post('link'),
						'class'=>$this->input->post('webclass'));
					$this->Hindi_admin_model->updateValue($param,'hindi_websites',array('id'=>$this->input->post('id')));
					$this->session->set_flashdata('success', 'Websites Updated Successfully');
					redirect('admin/hindi/all-website');
				
				}




			
		}
		else
		{	
			$id=$this->input->get('id');
			if(preg_replace('#[^0-9]#i', '', $id))
			{
				$param=array('id'=>$id);
				$data['data']=$this->Hindi_admin_model->getData('hindi_websites',$param);
				$this->load->view('admin/hindi/includes/header');
				$this->load->view('admin/hindi/update-website',$data);
				$this->load->view('admin/hindi/includes/footer');
			}
			else
			{
				redirect('admin/hindi/all-website');
			}
			
		}

		} // If Ends Here
		else
		{
			redirect('admin/hindi/dashboard');
		}
	}
	public function delete()
	{
		if($this->session->userdata('user_id'))
		{
			$id=$this->input->get('id');
			if(preg_replace('#[^0-9]#i', '', $id))
			{
				$param=array('id'=>$id);
				$this->Hindi_admin_model->deleteData('hindi_websites',$param);
				$this->session->set_flashdata('success', 'Record Deleted Successfully');
				redirect('admin/hindi/all-website');
			}
			else
			{
				redirect('admin/hindi/all-website');
			}
		}
		else
		{
			redirect('admin/hindi/dashboard');
		}
	}

}
