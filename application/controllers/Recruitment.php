<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recruitment extends CI_Controller {
	public function __construct() 
    {
		 parent:: __construct();		 
		 $this->load->model('Common_model');
		 $this->load->library('email');
		 // $this->load->model('Join_model');
	}

					
	public function index()
	{
		$param=array('parent_id'=>0,'header'=>'Y');
		$data['cms']=$this->Common_model->dbQuery1("SELECT * FROM `cms_pages` WHERE `parent_id`=0 AND `header`='Y' ORDER BY menu_order ASC");
		$data['recruitment']=$this->Common_model->get_data('advertise_mst',array('status'=>'Y'),'id');
		$data['metaTitle']='Recruitment';
		$data['metaKeywords']='Recruitment';
		$data['metaDescription']='Recruitment';
		$this->load->view('includes-recruitment/header',$data);
		$this->load->view('recruitment/recruitment-view',$data);
		$this->load->view('includes-recruitment/footer');
	}

}

?>