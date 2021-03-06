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
		if($this->session->userdata('user_id'))
		{
		$this->load->view('admin/includes/function');	
		$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
		$limit = 10;
		$startpoint = ($page * $limit) - $limit;
		$statement = "`cms_pages`";
		$data['cms'] =$this->Admin_model->getAll('cms_pages',$param='',$order_by_fld='',$order_by='',$limit,$startpoint);
		//print_r($data['cms']);
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
		else
		{
			redirect('admin');
		}
	}
	public function add_cms()
	{
		if($this->session->userdata('user_id'))
		{


		if($this->input->post('title'))
		{
			
			$config['upload_path'] = './public/uploaded';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$this->load->library('upload', $config);
			//print_r($this->input->post());die();
			if($this->upload->do_upload('fileup'))
				{
					$image_detail = $this->upload->data();
					//print_r($image_detail);
					$file_name = $image_detail['file_name'];
					if($this->input->post('menu')){
						
						$param=array('page_title'=>$this->input->post('title'),
						'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))),
						'content'=>$this->input->post('content'),
						'meta_title'=>$this->input->post('metatitle'),
						'meta_keywords'=>$this->input->post('metakey'),
						'meta_description'=>$this->input->post('metadesc'),
						 $this->input->post('menu')=>'Y',
						'parent_id'=>$this->input->post('parent'),'image'=>$file_name,'status'=>'Y');
					}
					else	
					{
						$param=array('page_title'=>$this->input->post('title'),
						'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))),
						'content'=>$this->input->post('content'),
						'meta_title'=>$this->input->post('metatitle'),
						'meta_keywords'=>$this->input->post('metakey'),
						'meta_description'=>$this->input->post('metadesc'),
						 
						'parent_id'=>$this->input->post('parent'),'image'=>$file_name,'status'=>'Y');
					}
					
					$this->Admin_model->insertData('cms_pages',$param);

					$this->session->set_flashdata('msg', 'Cms pages added successfully');
					redirect('admin/cms-page');
				}
				else
				{	
					if($this->input->post('parent') == '')		
					{
						$parentId = 0;
					}
					else{
						$parentId = $this->input->post('parent');
					}	

					if($this->input->post('menu')){
						
						$param=array('page_title'=>$this->input->post('title'),
						'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))),
						'content'=>$this->input->post('content'),
						'meta_title'=>$this->input->post('metatitle'),
						'meta_keywords'=>$this->input->post('metakey'),
						'meta_description'=>$this->input->post('metadesc'),
						$this->input->post('menu')=>'Y',
						'image' => '',
						'parent_id'=> $parentId,'status'=>'Y');
					}
					else
					{
						$param=array('page_title'=>$this->input->post('title'),
						'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))),
						'content'=>$this->input->post('content'),
						'meta_title'=>$this->input->post('metatitle'),
						'meta_keywords'=>$this->input->post('metakey'),
						'meta_description'=>$this->input->post('metadesc'),
						'image' => '',
						'parent_id'=> $parentId,'status'=>'Y');
					}
					
					//print_r($param);
					//print_r($_POST);
					$this->Admin_model->insertData('cms_pages',$param);
					//echo $this->db->insert_id();

					
					//die();
					$this->session->set_flashdata('msg', 'Cms pages added successfully');
					redirect('admin/cms-page');
				}
		}
		else
		{
			$this->load->view('admin/includes/header');
			$this->load->view('admin/add-cms');
			$this->load->view('admin/includes/footer');
		}
	 }
	 else
		{
			redirect('admin');
		}
	}
	public function Delete()
	{
		
	if($this->session->userdata('user_id'))
		{
		$id=$this->input->get('id');
		if(!$this->input->get('id'))
		{
		
			redirect('admin/cms-page');
		}
		else
		{
		$res=$this->Admin_model->delete($id);
		if($res==1)
		redirect('admin/cms-page');
		}

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
		$id=$this->input->get('id');
		$data['cms_row'] =$this->Admin_model->view_edit_cms($id);
		$this->load->view('admin/includes/header');
		$this->load->view('admin/edit_cms',$data);
		$this->load->view('admin/includes/footer');
		}
		else
		{
			redirect('admin');
		}
		
	}
	public function editcms()
	{
		
		if($this->session->userdata('user_id'))
		{
		$a=$this->input->post('id');
		
		if($this->input->post('edit_page'))
		
		{
			
			$config['upload_path'] = './public/uploaded';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$this->load->library('upload', $config);
		
		
		
		
		
		
				if($this->upload->do_upload('fileup'))
				{
					$image_detail = $this->upload->data();
					$file_name = $image_detail['file_name'];


					if($this->input->post('parent') != ''){

						$param=array('page_title'=>$this->input->post('title'),'content'=>$this->input->post('content'),
						'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))),
						'meta_title'=>$this->input->post('metatitle'),'meta_keywords'=>$this->input->post('metakey'),'meta_description'=>$this->input->post('metadesc'),
						
						'parent_id'=>$this->input->post('parent'),'image'=>$file_name,'status'=>'Y','id'=>$a);
					}
					else
					{
						$param=array('page_title'=>$this->input->post('title'),'content'=>$this->input->post('content'),
						'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))),
						'meta_title'=>$this->input->post('metatitle'),'meta_keywords'=>$this->input->post('metakey'),'meta_description'=>$this->input->post('metadesc'),
						'image'=>$file_name,'status'=>'Y','id'=>$a);
					}
					

					$this->Admin_model->updateData('cms_pages',$param);





					$this->session->set_flashdata('msg', 'Data Updated');
					//echo "updated";
					redirect('admin/cms-page/add-cms');
				}
				else
				{

					if($this->input->post('parent') != ''){

						$param=array('id'=>$a,'page_title'=>$this->input->post('title'),'content'=>$this->input->post('content'),
					'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))),
					'meta_title'=>$this->input->post('metatitle'),'meta_keywords'=>$this->input->post('metakey'),'meta_description'=>$this->input->post('metadesc'),
					'parent_id'=>$this->input->post('parent'),'status'=>'Y');

					}
					else
					{
							$param=array('id'=>$a,'page_title'=>$this->input->post('title'),'content'=>$this->input->post('content'),
					'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))),
					'meta_title'=>$this->input->post('metatitle'),'meta_keywords'=>$this->input->post('metakey'),'meta_description'=>$this->input->post('metadesc'),'status'=>'Y');
					}

					


					$res=$this->Admin_model->updateData('cms_pages',$param);

					if($this->input->post('menu')=='header')
					{
						$param1=array('header'=>'Y','footer'=>'N','other'=>'N');
						$this->Admin_model->updateValue($param1,'cms_pages',array('id'=>$this->input->post('id')));
					}
					elseif($this->input->post('menu')=='footer')
					{
						$param1=array('header'=>'N','footer'=>'Y','other'=>'N');
						$this->Admin_model->updateValue($param1,'cms_pages',array('id'=>$this->input->post('id')));
					}
					else
					{
						$param1=array('header'=>'N','footer'=>'N','other'=>'Y');
						$this->Admin_model->updateValue($param1,'cms_pages',array('id'=>$this->input->post('id')));
					}

					$this->session->set_flashdata('msg', 'Data Updated');
					redirect('admin/cms-page');
					
				}
		}
		else
			{
			$this->load->view('admin/includes/header');
			$this->load->view('admin/add-cms');
			$this->load->view('admin/includes/footer');
		}
		
		}
		else
		{
			redirect('admin');
		}	
	
	}
	
}
