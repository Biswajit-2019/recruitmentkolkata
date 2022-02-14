<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		
		$this->load->database();
		$this->load->model(array('Common_model'));
		$this->load->library('user_agent');
		$this->load->library('email'); 
		if(!$this->session->userdata('logged_in')) {
			redirect();
		} 
      }

	public function index()
	{
		//$data['applicationStatus'] = $educationCount = $this->Common_model->getNumrows('application_mst',array('user_id'=>$this->session->userdata('id'),'status'=>'Y'));
		$data['applicationStatus'] =0;
		$data['metaTitle']='Dashboard';
		$data['metaKeywords']='Dashboard';
		$data['metaDescription']='Dashboard';
		$this->load->view('includes-recruitment/user-dash-header',$data);
		$this->load->view('recruitment/dash-view',$data);
		$this->load->view('includes-recruitment/footer');
	}
	public function thank_you()
	{
		if($this->input->get('id')){
			$applicationNo = $this->input->get('id');
			$data['personal_data'] = $this->Common_model->get_single('personal_mst', array('application_no'=>$applicationNo));
		}else{
			$data['personal_data'] = '';
		}
		$data['metaTitle']='Thank You';
		$data['metaKeywords']='Thank You';
		$data['metaDescription']='Thank You';
		$this->load->view('includes-recruitment/user-dash-header',$data);
		$this->load->view('recruitment/thank-you',$data);
		$this->load->view('includes-recruitment/footer');
	}
	public function status()
	{
		if($this->session->userdata('id')){
			$userId = $this->session->userdata('id');
			$data['application'] = $this->Common_model->get_data('application_mst',array('user_id'=>$userId,'status'=>'Y'),'id');
		}else{
			$data['application'] = '';
		}
		$data['metaTitle']='Dashboard';
		$data['metaKeywords']='Dashboard';
		$data['metaDescription']='Dashboard';
		$this->load->view('includes-recruitment/user-dash-header',$data);
		$this->load->view('recruitment/application-status',$data);
		$this->load->view('includes-recruitment/footer');

	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect();
	}

}
