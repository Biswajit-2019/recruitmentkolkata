<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

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
		$this->load->helper('file_upload');
		$this->load->library('session');
		$this->load->library('form_validation');
		
		$this->load->database();
		$this->load->model(array('Common_model'));
		$this->load->library('user_agent');
		$this->load->library('email'); 
		
      }

	public function index()
	{
		echo phpinfo();die();
		if($this->input->post('name')){
			$applicationNo = 123;
			$target_dir = "public/uploaded/".$applicationNo;
			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}
			if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
				$config['upload_path'] = $target_dir;
				$config['allowed_types'] = 'png|jpg|jpeg';
				$config['max_size'] = '100';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file')){
					$uploadData1 = $this->upload->data();
					$userImage = $target_dir.'/'.$uploadData1['file_name'];
					echo $userImage."<br>";
				}else{
					echo $this->upload->display_errors('', '');
				}
			}
			if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
				$config['upload_path'] = $target_dir;
				$config['allowed_types'] = 'png|jpg|jpeg';
				$config['max_size'] = '100';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('image')){
					$uploadData14 = $this->upload->data();
					$userImage22 = $target_dir.'/'.$uploadData14['file_name'];
					echo $userImage22;
				}else{
					echo $this->upload->display_errors('', '');
				}
			}

		}
		$data['metaTitle']='Test';
		$data['metaKeywords']='Test';
		$data['metaDescription']='Test';
		$this->load->view('includes-recruitment/user-header',$data);
		$this->load->view('recruitment/test',$data);
		$this->load->view('includes-recruitment/footer');
	}
	
}
