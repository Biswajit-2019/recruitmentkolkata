<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cms extends CI_Controller {
	public function __construct() 
    {
		 parent:: __construct();		 
		 $this->load->model('Common_model');
		 // $this->load->model('Join_model');
	}

	public function _remap($method){
	//print_r("aaaaaa");		
		//$data['captchaValue'] = $this->generateCaptcha();		
		 $method=str_replace('_','-',$method);
		 if($method){
		 	$displayPage = $this->Common_model->getSingle('hindi_cms_pages',array('slug'=>$method),'','','','');		
			if($displayPage){
				$param=array('parent_id'=>0);
				$data['cms']=$this->Common_model->getData('hindi_cms_pages',$param);
				$data['main']=$displayPage;
				$data['page_title'] = $displayPage->page_title;
				$data['displayPage'] = $displayPage;	



				$meta=$this->Common_model->getSingle('hindi_cms_pages',array('id'=>1),$order_by_fld='',$order_by='',$limit='',$offset='');
				//$this->load->view('cms-page',$data);
				
				$data['metaTitle']=$displayPage->meta_title;
				$data['metaKeywords']=$displayPage->meta_keywords;
				$data['metaDescription']=$displayPage->meta_description;
				
				
				$this->load->view('hindi/includes/header',$data);
				$this->load->view('hindi/cms');
				$this->load->view('hindi/includes/footer');
				
			 }
		 }
		 else{
			 $this->load->view('include/header');
			 show_404();
			 $this->load->view('inlcude/footer');
		 }				
	}
}

?>