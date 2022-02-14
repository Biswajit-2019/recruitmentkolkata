<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hindi_home extends CI_Controller {
public function __construct()  
    {
		parent::__construct();	 
		$this->load->model(array('Common_model'));	
		
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$param=array('parent_id'=>0);
		$data['cms']=$this->Common_model->getData('cms_pages',$param);
		$data['banner']=$this->Common_model->getData('banner',array('status'=>'Y'));
		//print_r($data['banner']);
		$this->load->view('includes/header',$data);
		$this->load->view('home');
		$this->load->view('includes/footer');
	}
}
