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
		 	$displayPage = $this->Common_model->getSingle('cms_pages',array('slug'=>$method),'','','','');		
			if($displayPage){
				$param=array('parent_id'=>0,'header'=>'Y');
				$data['cms']=$this->Common_model->dbQuery1("SELECT * FROM `cms_pages` WHERE `parent_id`=0 AND `header`='Y' ORDER BY menu_order ASC");
				$data['main']=$displayPage;
				$meta=$this->Common_model->getSingle('cms_pages',array('id'=>$displayPage->id),$order_by_fld='',$order_by='',$limit='',$offset='');
				$data['metaTitle']=$displayPage->meta_title;
				$data['metaKeywords']=$displayPage->meta_keywords;
				$data['metaDescription']=$displayPage->meta_description;
				$this->load->view('includes/header',$data);
				$this->load->view('cms');
				$this->load->view('includes/footer');
				
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
