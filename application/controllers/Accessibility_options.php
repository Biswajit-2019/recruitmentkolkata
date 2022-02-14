<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accessibility_options extends CI_Controller {
	public function __construct() 
    {
		 parent:: __construct();		 
		 $this->load->model('Common_model');
		 $this->load->library('form_validation');
		 $this->load->library('email');
		 $this->email->set_mailtype("html");
		 // $this->load->model('Join_model');
	}

	public function index(){
		
	
			    $param=array('parent_id'=>0,'header'=>'Y');
				$data['cms']= $this->Common_model->dbQuery1("SELECT * FROM `cms_pages` WHERE `parent_id`=0 AND `header`='Y' ORDER BY menu_order ASC");
				$data['metaTitle']='Accessibility Options';
				$data['metaKeywords']='Accessibility Options';
				$data['metaDescription']='Accessibility Options';
				$this->load->view('includes/header',$data);
				$this->load->view('accessibility');
				$this->load->view('includes/footer');
		
	}
	

}

?>
