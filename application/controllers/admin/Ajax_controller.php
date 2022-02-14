<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_controller extends CI_Controller {
	
	 public function __construct() {
		 
		parent::__construct(); 		 
		$this->load->model(array('Common_model'));
		$this->load->library('cart');
	}
	
	public function check_hindi_advt_no(){
		$advtNo = $_REQUEST['advtNo'];	
		$data = $this->Common_model->getAll('advertise_mst',array('advt_no'=>$advtNo),'','','','');
		//print_r($data);
		$count =  count($data);
		//$valid = true;
		if($count > 0){
			$valid = false;
		}
		else{
			$valid = true;
		}
		echo json_encode($valid);
		
		exit();
		
	}
	public function check_advt_no(){
		$advtNo = $_REQUEST['advtNo'];	
		$data = $this->Common_model->getAll('advertise_mst',array('advt_no'=>$advtNo),'','','','');
		//print_r($data);
		$count =  count($data);
		//$valid = true;
		if($count > 0){
			$valid = false;
		}
		else{
			$valid = true;
		}
		echo json_encode($valid);
		
		exit();
		
	}
	public function check_training_no(){
		$trainingNo = $_REQUEST['trainingNo'];	
		$data = $this->Common_model->getAll('training_mst',array('training_no'=>$trainingNo),'','','','');
		//print_r($data);
		$count =  count($data);
		//$valid = true;
		if($count > 0){
			$valid = false;
		}
		else{
			$valid = true;
		}
		echo json_encode($valid);
		
		exit();
		
	}
	
	public function check_advert_title(){
		$advert_name = strtolower(str_replace(" ","-",$_REQUEST['pageurl']));	
		$data = $this->Common_model->getAll('cms_pages',array('slug'=>$advert_name),'','','','');
		//print_r($data);
		$count =  count($data);
		//$valid = true;
		if($count > 0){
			$valid = false;
		}
		else{
			$valid = true;
		}
		echo json_encode($valid);
		
		exit();
		
	}
	
	public function check_advert_title_hindi(){
		$advert_name = strtolower(str_replace(" ","-",$_REQUEST['pageurl']));	
		$data = $this->Common_model->getAll('hindi_cms_pages',array('slug'=>$advert_name),'','','','');
		//print_r($data);
		$count =  count($data);
		//$valid = true;
		if($count > 0){
			$valid = false;
		}
		else{
			$valid = true;
		}
		echo json_encode($valid);
		
		exit();
		
	}

	public function check_advert_title_en_edit(){
		$advert_name = strtolower(str_replace(" ","-",$_REQUEST['pageurl']));	
		$data = $this->Common_model->getAll('cms_pages',array('slug'=>$advert_name),'','','','');
		//print_r($data);
		$count =  count($data);
		//$valid = true;
		if($count > 1){
			$valid = false;
		}
		else{
			$valid = true;
		}
		echo json_encode($valid);
		
		exit();
		
	}

	public function check_advert_title_hindi_edit(){
		$advert_name = strtolower(str_replace(" ","-",$_REQUEST['pageurl']));	
		$data = $this->Common_model->getAll('hindi_cms_pages',array('slug'=>$advert_name),'','','','');
		//print_r($data);
		$count =  count($data);
		//$valid = true;
		if($count > 1){
			$valid = false;
		}
		else{
			$valid = true;
		}
		echo json_encode($valid);
		
		exit();
		
	}

	
	
}

/* End of file ajax_controller.php */
/* Location: ./application/controllers/ajax_controller.php */