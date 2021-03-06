<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_page extends CI_Controller {

public function __construct()  
    {
		parent::__construct();	 
		$this->load->model('Hindi_admin_model');	
		
	}

	public function index()
	{
		if($this->session->userdata('user_id'))
		{
		$this->load->view('admin/hindi/includes/function');	
		$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
		$limit = 5;
		$startpoint = ($page * $limit) - $limit;
		$statement = "`hindi_cms_pages`";
		$data['cms'] =$this->Hindi_admin_model->getAll('hindi_cms_pages',$param='',$order_by_fld='',$order_by='',$limit,$startpoint);
		$Num=$this->Hindi_admin_model->getCounts("SELECT COUNT(*) as `num` FROM {$statement}");
		$data['num']=$Num[0]->num;
		$data['limit'] = $limit;
		$data['startpoint'] = $startpoint;
		$data['statement'] = $statement;
		$data['page'] = $page;

		$this->load->view('admin/hindi/includes/header');
		$this->load->view('admin/hindi/cms-listing',$data);
		$this->load->view('admin/hindi/includes/footer');
		}
		else
		{
			redirect('admin/hindi');
		}
	}
	public function add_cms()
	{
		if($this->session->userdata('user_id'))
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
					//print_r($image_detail);
					$file_name = $image_detail['file_name'];	
					$param=array('page_title'=>$this->input->post('title'), 'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))),'content'=>$this->input->post('content'),
					'meta_title'=>$this->input->post('metatitle'),
					'meta_keywords'=>$this->input->post('metakey'),
					'meta_description'=>$this->input->post('metadesc'),
					$this->input->post('menu')=>'Y',
					
					
					'parent_id'=>$this->input->post('parent'),'image'=>$file_name,'status'=>'Y');
					$this->Hindi_admin_model->insertData('hindi_cms_pages',$param);
					redirect('admin/hindi/cms-page');
				}
				else
				{
					$param=array('page_title'=>$this->input->post('title'),'content'=>$this->input->post('content'),
					
					'meta_title'=>$this->input->post('metatitle'),
					'meta_keywords'=>$this->input->post('metakey'),
					'meta_description'=>$this->input->post('metadesc'),
					
					
					$this->input->post('menu')=>'Y',
					'parent_id'=>$this->input->post('parent'),'status'=>'Y','slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))));
					$this->Hindi_admin_model->insertData('hindi_cms_pages',$param);
					redirect('admin/hindi/cms-page');
				}
		}
		else
		{
			$this->load->view('admin/hindi/includes/header');
			$this->load->view('admin/hindi/add-cms');
			$this->load->view('admin/hindi/includes/footer');
		}
		}
	else
			
		{
			redirect('admin/hindi');
		}
	}
	public function Delete()
	{
		
		//echo $id;
		if($this->session->userdata('user_id'))
	{
		$id=$this->input->get('id');
		if(!$this->input->get('id'))
		{
		
			redirect('admin/hindi/cms-page');
		}
		else
		{
		$res=$this->Hindi_admin_model->delete($id);
		if($res==1)
		redirect('admin/hindi/cms-page');
		}
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
			
		$id=$this->input->get('id');
		$data['cms_row'] =$this->Hindi_admin_model->view_edit_cms($id);
		$this->load->view('admin/hindi/includes/header');
		$this->load->view('admin/hindi/edit_cms',$data);
		$this->load->view('admin/hindi/includes/footer');
	}
	else
		{
			redirect('admin/hindi');
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
					'meta_title'=>$this->input->post('metatitle'),
					'meta_keywords'=>$this->input->post('metakey'),
					'meta_description'=>$this->input->post('metadesc'),
					$this->input->post('menu')=>'Y',
					'parent_id'=>$this->input->post('parent'),'image'=>$file_name,'status'=>'Y','id'=>$a,'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))));

					}
					else
					{


						$param=array('page_title'=>$this->input->post('title'),'content'=>$this->input->post('content'),
						
						'meta_title'=>$this->input->post('metatitle'),
						'meta_keywords'=>$this->input->post('metakey'),
						'meta_description'=>$this->input->post('metadesc'),
						$this->input->post('menu')=>'Y',			
						'image'=>$file_name,'status'=>'Y','id'=>$a,'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))));
					}
				
					$this->Hindi_admin_model->updateData1('hindi_cms_pages',$param);
					$this->session->set_flashdata('msg', 'Data Updated');
					
					redirect('admin/hindi/cms-page/add-cms');
				}
				else
				{


					if($this->input->post('parent') != ''){

						$param=array('id'=>$a,'page_title'=>$this->input->post('title'),'content'=>$this->input->post('content'),
					
					'meta_title'=>$this->input->post('metatitle'),
					'meta_keywords'=>$this->input->post('metakey'),
					'meta_description'=>$this->input->post('metadesc'),
					$this->input->post('menu')=>'Y',
					'parent_id'=>$this->input->post('parent'),'status'=>'Y','slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))));

					}
					else
					{
						$param=array('id'=>$a,
							'page_title'=>$this->input->post('title'),
							'content'=>$this->input->post('content'),
						    'meta_title'=>$this->input->post('metatitle'),
						    'meta_keywords'=>$this->input->post('metakey'),
						    'meta_description'=>$this->input->post('metadesc'),
						    $this->input->post('menu')=>'Y',
						    'status'=>'Y',
						    'slug'=>strtolower(str_replace(" ","-",$this->input->post('pageurl'))));
					}
					
					
					$res=$this->Hindi_admin_model->updateData1('hindi_cms_pages',$param);
					$this->session->set_flashdata('msg', 'Data Updated');
					redirect('admin/hindi/cms-page');
					
				}
		}
		else
			{
			$this->load->view('admin/hindi/includes/header');
			$this->load->view('admin/hindi/add-cms');
			$this->load->view('admin/hindi/includes/footer');
		}
	}
	else
		{
			redirect('admin/hindi');
		}
			
	}
	
}
