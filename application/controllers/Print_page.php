<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Print_page extends CI_Controller {
	public function __construct() 
    {
		 parent:: __construct();		 
		 $this->load->model('Common_model');
		 $this->load->library('form_validation');
		 $this->load->library('email');
		 $this->email->set_mailtype("html");
		 // $this->load->model('Join_model');
	}

	public function page(){
		
		 $method=$this->uri->segment(3);
		 $method=str_replace('_','-',$method);
		 $displayPage = $this->Common_model->getSingle('cms_pages',array('slug'=>$method),'','','','');
		 
		 
  	    $data['main']=$displayPage;
		$param=array('parent_id'=>0,'header'=>'Y');
		$data['cms']=$this->Common_model->getData('cms_pages',$param);
		$data['metaTitle']='Feed Back';
		$data['metaKeywords']='Feed Back';
		$data['metaDescription']='Feed Back';
		$this->load->view('includes/header',$data);
		$this->load->view('print-view');
		$this->load->view('includes/footer');
		  
		 
			

	}
	

}

?>