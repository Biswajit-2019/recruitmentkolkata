<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisement extends CI_Controller {

public function __construct()  
    {
		parent::__construct();	 
		$this->load->model(array('Common_model','Admin_model'));
		$this->load->library('form_validation');	
		
	}

	public function index()
	{
		if($this->session->userdata('user_id')){
			$this->load->view('admin/includes/function');
			$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
			$limit = 5;
			$startpoint = ($page * $limit) - $limit;
			$statement = "`hindi_advertise_mst`";
			$data['cms'] =$this->Admin_model->getAll('hindi_advertise_mst',$param=array('status'=>'Y'),$order_by_fld='',$order_by='',$limit,$startpoint);
			$Num=$this->Admin_model->getCounts("SELECT COUNT(*) as `num` FROM {$statement} WHERE status='Y' ");
			$data['num']=$Num[0]->num;
			$data['limit'] = $limit;
			$data['startpoint'] = $startpoint;
			$data['statement'] = $statement;
			$data['page'] = $page;
			$this->load->view('admin/hindi/includes/header');
			$this->load->view('admin/hindi/recruitment/advertisement',$data);
			$this->load->view('admin/hindi/includes/footer');
		}else{
			redirect('admin/hindi/');
		}
	}
	public function add()
	{
		if($this->session->userdata('user_id')){
			if($this->input->post('advtNo')){
				$target_dir = './public/uploaded/advertisement';
				$dir = 'public/uploaded/advertisement/';
				if (!file_exists($target_dir)) {
					mkdir($target_dir, 0777, true);
				}
				$config['upload_path'] = $target_dir;
				$config['file_name']          = time();
				$config['allowed_types'] = 'pdf';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('vacancyDetails')) {
					$imageData = $this->upload->data(); 
					$vacancyDetail = $dir.$imageData['file_name'];
				}else{
					$vacancyDetail = ' ';
				}
				if ($this->upload->do_upload('vacancyDetails')) {
					$imageData1 = $this->upload->data();
					$guidelines = $dir.$imageData1['file_name'];
				}else{
					$guidelines = '';
				}
				$date = date_format(date_create_from_format('d-m-Y', $this->input->post('date')), 'Y-m-d');
				$data = array('guideline_status'=>$this->input->post('guideline_status'),'advt_no'=>$this->input->post('advtNo'),'date'=>$date,'vacancy_description'=>$this->input->post('vacancyDescription'),'vacancy_details'=>$vacancyDetail,'guideline'=>$guidelines,'important_content'=>$this->input->post('important'),'status'=>'Y','create_date'=>date("Y-m-d H:i:s"),'update_date'=>date("Y-m-d H:i:s"));
					$create = $this->Common_model->insertValue('hindi_advertise_mst', $data);
					if ($create > 0) {
						$this->session->set_flashdata('success', 'Successfully created');
						redirect('admin/hindi/advertisement/');
					} else {
						$this->session->set_flashdata('errors', 'Error occurred!!');
						redirect('admin/hindi/advertisement/');
					}

			}else{
				$this->load->view('admin/hindi/includes/header');
				$this->load->view('admin/hindi/recruitment/add-advertisement');
				$this->load->view('admin/hindi/includes/footer');
			}

		}else{
			redirect('admin/hindi/');
		}
	}

	public function edit()
	{
		if($this->session->userdata('user_id')){
			if($this->input->get('id')){
				$data['advertisement']=$this->Admin_model->getData('hindi_advertise_mst',array('id'=>$this->input->get('id'),'status'=>'Y'));
				$this->load->view('admin/hindi/includes/header');
				$this->load->view('admin/hindi/recruitment/update-advertisement',$data);
				$this->load->view('admin/hindi/includes/footer');

			}else{
				if($this->input->post('update_Advertisement')){
					$id = $this->input->post('id');
					$single = $this->Admin_model->getData('hindi_advertise_mst',array('id'=>$id));
					//print_r($single);
					$oldVacancyDetail = $single[0]->vacancy_details;
					$oldGuideline = $single[0]->guideline;
					
					$target_dir = './public/uploaded/advertisement';
					$dir = 'public/uploaded/advertisement/';
					if (!file_exists($target_dir)) {
						mkdir($target_dir, 0777, true);
					}
					$config['upload_path'] = $target_dir;
					$config['file_name']          = time();
					$config['allowed_types'] = 'pdf';
					$this->load->library('upload', $config);
					if (isset($_FILES['vacancyDetails']) && !empty($_FILES['vacancyDetails']['name'])) {
						if ($this->upload->do_upload('vacancyDetails')) {
							$imageData = $this->upload->data(); 
							$vacancyDetail = $dir.$imageData['file_name'];
							$temp = $this->Admin_model->updateValue(array('vacancy_details'=>$vacancyDetail),'hindi_advertise_mst',array('id'=>$this->input->post('id')));
							//($temp)?unlink($oldVacancyDetail):'';
						}else{
							$this->session->set_flashdata('errors', $this->upload->display_errors());
							redirect('admin/hindi/advertisement/edit?id='.$id);
						}
					}
					if (isset($_FILES['guidelines']) && !empty($_FILES['guidelines']['name'])) {
						if ($this->upload->do_upload('guidelines')) {
							$imageData1 = $this->upload->data(); 
							$guidelines = $dir.$imageData1['file_name'];
							$temp1 = $this->Admin_model->updateValue(array('guideline'=>$guidelines),'hindi_advertise_mst',array('id'=>$this->input->post('id')));
							//($temp1)?unlink($oldGuideline):'';
						}else{
							$this->session->set_flashdata('errors', $this->upload->display_errors());
							redirect('admin/hindi/advertisement/edit?id='.$id);
						}
					}
					$date = date_format(date_create_from_format('d-m-Y', $this->input->post('date')), 'Y-m-d');
					$data = array('guideline_status'=>$this->input->post('guideline_status'),'advt_no'=>$this->input->post('advtNo'),'date'=>$date,'vacancy_description'=>$this->input->post('vacancyDescription'),'important_content'=>$this->input->post('important'),'status'=>'Y','job_status'=>$this->input->post('job_status'),'update_date'=>date("Y-m-d H:i:s"));
					$this->Admin_model->updateValue($data,'hindi_advertise_mst',array('id'=>$this->input->post('id')));
					$this->session->set_flashdata('success', 'Updated Successfully');
					redirect('admin/hindi/advertisement/');
				}

			}

		}else{
			redirect('admin/hindi/');
		}
	}
	public function uploade()
	{
		$id = $this->input->post('id');
		$single = $this->Common_model->get_single('hindi_advertise_mst',array('id'=>$id));
		$oldResult = $single->result;
		$target_dir = './public/uploaded/advertisement';
		$dir = 'public/uploaded/advertisement/';
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}
		if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
			$config['upload_path'] = $target_dir;
			$config['file_name']          = time();
			$config['allowed_types'] = 'pdf';
			$this->load->library('upload', $config);
			if($this->upload->do_upload('file')){
				$imageData = $this->upload->data(); 
				$resultDetail = $dir.$imageData['file_name'];
				$temp = $this->Admin_model->updateValue(array('result_status'=>$this->input->post('result_status'),'result'=>$resultDetail,'job_status'=>'N'),'hindi_advertise_mst',array('id'=>$this->input->post('id')));
				$this->session->set_flashdata('success', 'Updated Successfully');
				redirect('admin/hindi/advertisement/');
			}else{
				$this->session->set_flashdata('errors', $this->upload->display_errors());
				redirect('admin/hindi/advertisement/result?id='.$id);
			}
			
		}else{
			$this->form_validation->set_rules('file', 'file', 'required');
		}
		if ($this->form_validation->run() == TRUE) {
		}else{
			$this->session->set_flashdata('file', form_error('file'));
			redirect('admin/hindi/advertisement/result?id='.$id);
		}
	}
	public function result()
	{
		if($this->session->userdata('user_id')){
			$data['advertisement']=$this->Common_model->get_single('hindi_advertise_mst',array('id'=>$this->input->get('id'),'status'=>'Y'));
			$this->load->view('admin/hindi/includes/header');
			$this->load->view('admin/hindi/recruitment/publish-result',$data);
			$this->load->view('admin/hindi/includes/footer');
		}else{
			redirect('admin/hindi/');
		}
	} 
	public function delete()
	{
		if($this->session->userdata('user_id')){
			if($this->input->get('id')){
				$this->Admin_model->updateValue(array('status'=>'N'),'hindi_advertise_mst',array('id'=>$this->input->get('id')));
				$this->session->set_flashdata('success', 'Deleted Successfully');
				redirect('admin/advertisement');
			}else{
				$this->session->set_flashdata('errors', 'Error occurred!!');
				redirect('admin/hindi/advertisement/');
			}
		}else{
			redirect('admin');
		}
	}
}
