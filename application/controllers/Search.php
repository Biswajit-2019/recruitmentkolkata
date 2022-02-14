<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search extends CI_Controller {
	public function __construct() 
    {
		 parent:: __construct();		 
		 $this->load->model('Common_model');
		 // $this->load->model('Join_model');
	}

					
	public function index()
	{
		if($this->input->post('searchbtn'))
		{
			
			$param1=array(43);
			$data['searchResult']=$this->Common_model->search('cms_pages',$this->input->post('txtsearch'),$param1);
			$param=array('parent_id'=>0,'header'=>'Y');
			$data['cms']=$this->Common_model->dbQuery1("SELECT * FROM `cms_pages` WHERE `parent_id`=0 AND `header`='Y' ORDER BY menu_order ASC");
			$data['metaTitle']='Search';
			$data['metaKeywords']='Search';
			$data['metaDescription']='Search';
			$this->load->view('includes/header',$data);
			$this->load->view('search-view',$data);
			$this->load->view('includes/footer');
		}
		else
		{
			$param=array('parent_id'=>0,'header'=>'Y');
			$data['cms']=$this->Common_model->getData('cms_pages',$param);
			$data['metaTitle']='Search';
			$data['metaKeywords']='Search';
			$data['metaDescription']='Search';
			$this->load->view('includes/header',$data);
			$this->load->view('search-view');
			$this->load->view('includes/footer');
		}
		
	}

}

?>
