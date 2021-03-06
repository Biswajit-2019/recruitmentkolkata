<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_website extends CI_Controller {

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
		$statement = "`websites`";
		$param=array('status'=>'Y');
		$data['cms'] =$this->Admin_model->getAll('websites',$param,$order_by_fld='',$order_by='',$limit,$startpoint);
		$Num=$this->Admin_model->getCounts("SELECT COUNT(*) as `num` FROM {$statement}");
		$data['num']=$Num[0]->num;
		$data['limit'] = $limit;
		$data['startpoint'] = $startpoint;
		$data['statement'] = $statement;
		$data['page'] = $page;

		$this->load->view('admin/includes/header');
		$this->load->view('admin/all-website',$data);
		$this->load->view('admin/includes/footer');
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

		if($this->input->post('title'))
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
					$this->Admin_model->insertData('websites',$param);
					$this->session->set_flashdata('success', 'Websites Added Successfully');
					redirect('admin/all-website');
				}
				else
				{
					$param=array('web_title'=>$this->input->post('title'),'link'=>$this->input->post('link'),
					'class'=>$this->input->post('webclass'),
					'icon' => '',
					'status'=>'Y');
					$this->Admin_model->insertData('websites',$param);
					$this->session->set_flashdata('success', 'Websites Added Successfully');
					redirect('admin/all-website');
				}

			
				
		}
		else
		{
			$this->load->view('admin/includes/header');
			$this->load->view('admin/add-website');
			$this->load->view('admin/includes/footer');
		}

		} // If Ends Here
		else
		{
			redirect('admin');
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
					$this->Admin_model->updateValue($param,'websites',array('id'=>$this->input->post('id')));
					$this->session->set_flashdata('success', 'Websites Updated Successfully');
					redirect('admin/all-website');
				}
				else
				{
					$param=array('web_title'=>$this->input->post('title'),'link'=>$this->input->post('link'),
						'class'=>$this->input->post('webclass'));
					$this->Admin_model->updateValue($param,'websites',array('id'=>$this->input->post('id')));
					$this->session->set_flashdata('success', 'Websites Updated Successfully');
					redirect('admin/all-website');
				
				}




			
		}
		else
		{	
			$id=$this->input->get('id');
			if(preg_replace('#[^0-9]#i', '', $id))
			{
				$param=array('id'=>$id);
				$data['data']=$this->Admin_model->getData('websites',$param);
				$this->load->view('admin/includes/header');
				$this->load->view('admin/update-website',$data);
				$this->load->view('admin/includes/footer');
			}
			else
			{
				redirect('admin/all-website');
			}
			
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
			$id=$this->input->get('id');
			if(preg_replace('#[^0-9]#i', '', $id))
			{
				$param=array('id'=>$id);
				$this->Admin_model->deleteData('websites',$param);
				$this->session->set_flashdata('success', 'Record Deleted Successfully');
				redirect('admin/all-website');
			}
			else
			{
				redirect('admin/all-website');
			}
		}
		else
		{
			redirect('admin');
		}
	}

}
