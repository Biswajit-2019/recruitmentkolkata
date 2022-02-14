<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller {

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
			$statement = "`training_mst`";
			$data['cms'] =$this->Admin_model->getAll('training_mst',$param=array('status'=>'Y'),$order_by_fld='',$order_by='',$limit,$startpoint);
			$Num=$this->Admin_model->getCounts("SELECT COUNT(*) as `num` FROM {$statement} WHERE status='Y' ");
			$data['num']=$Num[0]->num;
			$data['limit'] = $limit;
			$data['startpoint'] = $startpoint;
			$data['statement'] = $statement;
			$data['page'] = $page;
			$this->load->view('admin/includes/header');
			$this->load->view('admin/training/training_list',$data);
			$this->load->view('admin/includes/footer');
		}else{
			redirect('admin');
		}
	}
	public function add()
	{
		if($this->session->userdata('user_id')){
			if($this->input->post('important')){
				
						$data = array('important_content'=>$this->input->post('important'),'status'=>'Y','create_date'=>date("Y-m-d H:i:s"),'update_date'=>date("Y-m-d H:i:s"));
						$create = $this->Common_model->insertValue('training_mst', $data);
						if ($create > 0) {
							$this->session->set_flashdata('success', 'Successfully created');
							redirect('admin/training/');
						} else {
							$this->session->set_flashdata('errors', 'Error occurred!!');
							redirect('admin/training/');
						}			

			}else{
				$this->load->view('admin/includes/header');
				$this->load->view('admin/training/add-training');
				$this->load->view('admin/includes/footer');
			}

		}else{
			redirect('admin');
		}
	}

	public function edit()
	{
		if($this->session->userdata('user_id')){
			if($this->input->get('id')){
				$data['training']=$this->Admin_model->getData('training_mst',array('id'=>$this->input->get('id'),'status'=>'Y'));
				$this->load->view('admin/includes/header');
				$this->load->view('admin/training/update-training',$data);
				$this->load->view('admin/includes/footer');

			}else{
				if($this->input->post('important')){
					$id = $this->input->post('id');
					$data = array('important_content'=>$this->input->post('important'),'status'=>'Y','update_date'=>date("Y-m-d H:i:s"));
					$this->Admin_model->updateValue($data,'training_mst',array('id'=>$id));
					$this->session->set_flashdata('success', 'Updated Successfully');
					redirect('admin/training/');
				}

			}

		}else{
			redirect('admin');
		}
	}
	public function uploade()
	{
		$id = $this->input->post('id');
		$single = $this->Common_model->get_single('advertise_mst',array('id'=>$id));
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
				$temp = $this->Admin_model->updateValue(array('result'=>$resultDetail,'job_status'=>'N'),'advertise_mst',array('id'=>$this->input->post('id')));
				$this->session->set_flashdata('success', 'Updated Successfully');
				redirect('admin/advertisement/');
			}else{
				$this->session->set_flashdata('errors', $this->upload->display_errors());
				redirect('admin/advertisement/result?id='.$id);
			}
			
		}else{
			$this->form_validation->set_rules('file', 'file', 'required');
		}
		if ($this->form_validation->run() == TRUE) {
		}else{
			$this->session->set_flashdata('file', form_error('file'));
			redirect('admin/advertisement/result?id='.$id);
		}
	}
	public function result()
	{
		if($this->session->userdata('user_id')){
			$data['advertisement']=$this->Common_model->get_single('advertise_mst',array('id'=>$this->input->get('id'),'status'=>'Y'));
			$this->load->view('admin/includes/header');
			$this->load->view('admin/publish-result',$data);
			$this->load->view('admin/includes/footer');
		}else{
			redirect('admin');
		}
	} 
	public function delete()
	{
		if($this->session->userdata('user_id')){
			if($this->input->get('id')){
				$this->Admin_model->updateValue(array('status'=>'N'),'training_application_mst',array('id'=>$this->input->get('id')));
				$this->session->set_flashdata('success', 'Deleted Successfully');
				redirect('admin/training/apply-list');
			}else{
				$this->session->set_flashdata('errors', 'Error occurred!!');
				redirect('admin/training/apply-list/');
			}
		}else{
			redirect('admin');
		}
	}
	public function apply_list()
	{
		if($this->session->userdata('user_id')){
			$this->load->view('admin/includes/function');
			$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
			$limit = 5;
			$startpoint = ($page * $limit) - $limit;
			$statement = "`training_application_mst`";
			$data['cms'] =$this->Admin_model->getAll('training_application_mst',$param=array('status'=>'Y','delete_status'=>''),$order_by_fld='id',$order_by='DESC',$limit,$startpoint);
			$Num=$this->Admin_model->getCounts("SELECT COUNT(*) as `num` FROM {$statement} WHERE status='Y' AND 'delete_status'='' ");
			$data['num']=$Num[0]->num;
			$data['limit'] = $limit;
			$data['startpoint'] = $startpoint;
			$data['statement'] = $statement;
			$data['page'] = $page;
			$this->load->view('admin/includes/header');
			$this->load->view('admin/training/apply-list',$data);
			$this->load->view('admin/includes/footer');
		}else{
			redirect('admin');
		}
	}
	public function details()
	{
		if($this->session->userdata('user_id')){
			if($this->input->post('id')){
				$status = $this->input->post('status');
				if($status==3){
					$interview_date = date_format(date_create_from_format('d-m-Y', $this->input->post('interviewDate')), 'Y-m-d');
					$update_date = array('application_status'=>$status,'interview_date'=>$interview_date);
				}else{
					$written_date = date_format(date_create_from_format('d-m-Y', $this->input->post('interviewDate')), 'Y-m-d');
					$update_date = array('application_status'=>$status,'written_date'=>$written_date);
				}
				if(!empty($status)){
					$interviewDate = date_format(date_create_from_format('d-m-Y', $this->input->post('interviewDate')), 'Y-m-d');
					$education_data_update = $this->Common_model->update_data('training_application_mst',array('id'=>$this->input->post('id')),$update_date);
					redirect('admin/training/apply-list');
				}else{
					redirect('admin/training/apply-list');
				}
				
			}else{
				$id = $this->input->get('id');
				$data['application'] = $this->Common_model->get_single('training_application_mst', array('id'=>$id));
				$applicationNo = $data['application']->application_no;
				$data['apply_data'] = $this->Common_model->get_single('training_apply_mst', array('application_no'=>$applicationNo));
				$this->load->view('admin/includes/header');
				$this->load->view('admin/training/apply-details',$data); 
				$this->load->view('admin/includes/footer');
			}
			
		}else{
			redirect('admin');
		}
	}
}
