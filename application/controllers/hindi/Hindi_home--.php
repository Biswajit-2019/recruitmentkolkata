<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hindi_home extends CI_Controller {

	public function __construct()  
    {
		parent::__construct();	 
		$this->load->model(array('Common_model'));	
		
	}
	public function index()
	{
		$param=array('parent_id'=>0);
		$data['cms']=$this->Common_model->getData('hindi_cms_pages',$param);
		$data['banner']=$this->Common_model->getData('hindi_banner',array('status'=>'Y'));
		$meta=$this->Common_model->getSingle('hindi_cms_pages',array('id'=>7),$order_by_fld='',$order_by='',$limit='',$offset='');
		$data['metaTitle']=$meta->meta_title;
		$data['metaKeywords']=$meta->meta_keywords;
		$data['metaDescription']=$meta->meta_description;
		$data['content']=$meta->content;
		//print_r($data['banner']);
		$this->load->view('hindi/includes/header',$data);
		$this->load->view('hindi/Hindi_home');
		$this->load->view('hindi/includes/footer');
	}
}
