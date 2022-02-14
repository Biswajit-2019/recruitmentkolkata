<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site_map extends CI_Controller {
	public function __construct() 
    {
		 parent:: __construct();		 
		 $this->load->model('Common_model');
		 // $this->load->model('Join_model');
	}

					
	public function index()
	{
		$param=array('parent_id'=>0,'header'=>'Y');
		$data['cms']= $this->Common_model->dbQuery1("SELECT * FROM `hindi_cms_pages` WHERE `parent_id`=0 AND `header`='Y' ORDER BY menu_order ASC");
		$data['metaTitle']='Site Map';
		$data['metaKeywords']='Site Map';
		$data['metaDescription']='Site Map';
		$this->load->view('hindi/includes/header',$data);
		$this->load->view('hindi/site-map');
		$this->load->view('hindi/includes/footer');
	}

}

?>
