<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_page extends CI_Controller {

public function __construct()  
    {
		parent::__construct();	 
		$this->load->model(array('Admin_model'));	
		
	}

	public function index()
	{

		$this->load->view('admin/includes/function');	
		$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
		$limit = 5;
		$startpoint = ($page * $limit) - $limit;
		$statement = "`cms_pages`";
		$data['cms'] =$this->Admin_model->getAll('cms_pages',$param='',$order_by_fld='',$order_by='',$limit,$startpoint);
		$Num=$this->Admin_model->getCounts("SELECT COUNT(*) as `num` FROM {$statement}");
		$data['num']=$Num[0]->num;
		$data['limit'] = $limit;
		$data['startpoint'] = $startpoint;
		$data['statement'] = $statement;
		$data['page'] = $page;

		$this->load->view('admin/includes/header');
		$this->load->view('admin/cms-listing',$data);
		$this->load->view('admin/includes/footer');
	}
	public function add_cms()
	{
		if($this->input->post('add_page'))
		{
			$config['upload_path'] = './public/uploaded';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$this->load->library('upload', $config);
			//print_r($this->input->post());
			if($this->upload->do_upload('fileup'))
				{
					$image_detail = $this->upload->data();
					print_r($image_detail);
					$file_name = $image_detail['file_name'];	
					$param=array('page_title'=>$this->input->post('title'),'content'=>$this->input->post('content'),
					'parent_id'=>$this->input->post('parent'),'image'=>$file_name,'status'=>'Y');
					$this->Admin_model->insertData('cms_pages',$param);
					redirect('admin/cms-page/add-cms');
				}
				else
				{
					$param=array('page_title'=>$this->input->post('title'),'content'=>$this->input->post('content'),
					'parent_id'=>$this->input->post('parent'),'status'=>'Y');
					$this->Admin_model->insertData('cms_pages',$param);
					redirect('admin/cms-page/add-cms');
				}
		}
		else
		{
			$this->load->view('admin/includes/header');
			$this->load->view('admin/add-cms');
			$this->load->view('admin/includes/footer');
		}
	}
}
