<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application extends CI_Controller {

public function __construct()  
    {
		parent::__construct();	 
		$this->load->library("pagination");
		$this->load->model(array('Common_model','Admin_model'));	
		
	}

	public function index()
	{
		if($this->session->userdata('user_id')){
			$Num = $this->Admin_model->getCounts("SELECT COUNT(*) as `num` FROM `application_mst` WHERE `status` = 'Y' AND `delete_status`=0");
			$resultCount = $Num[0]->num;
			$config = array();
			$config["base_url"] = base_url() . "admin/application";
	        $config["total_rows"] = $resultCount;
	        $config["per_page"] = 9;
	        $config['enable_query_strings'] = TRUE;
	        $config["uri_segment"] = 3;
	         $config['full_tag_open'] = "<ul class='pagination'>";
			$config['full_tag_close'] ="</ul>";
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] = "<li>";
			$config['next_tagl_close'] = "</li>";
			$config['prev_tag_open'] = "<li>";
			$config['prev_tagl_close'] = "</li>";
			$config['first_tag_open'] = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] = "<li>";
			$config['last_tagl_close'] = "</li>";
			$config['num_links'] = 3;
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$result['page'] = $page;

			 $data['cms'] = $this->Common_model->getDatawithlimit('application_mst',array('status'=>'Y','delete_status'=>0),'updated_at',$page,9);
			 //$data['cms'] =$this->Admin_model->getAll('application_mst',$param=array('status'=>'Y','delete_status'=>0),$order_by_fld='updated_at',$order_by='DESC',$limit,$startpoint);
			//echo $this->db->last_query(); 
	        $data["links"] = $this->pagination->create_links();
	        $data["totalCount"] = $resultCount;

			







			/*$this->load->view('admin/includes/function');
			$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
			$limit = 10;
			$startpoint = ($page * $limit) - $limit;
			$statement = "`application_mst`";
			$data['cms'] =$this->Admin_model->getAll('application_mst',$param=array('status'=>'Y','delete_status'=>0),$order_by_fld='updated_at',$order_by='DESC',$limit,$startpoint);
			$Num=$this->Admin_model->getCounts("SELECT COUNT(*) as `num` FROM application_mst WHERE status='Y' AND 'delete_status'=0");
			$data['num']=$Num[0]->num;
			$data['limit'] = $limit;
			$data['startpoint'] = $startpoint;
			$data['statement'] = $statement;
			$data['page'] = $page;*/
			$this->load->view('admin/includes/header');
			$this->load->view('admin/recruitment/application-list',$data);
			$this->load->view('admin/includes/footer');
		}else{
			redirect('admin');
		}
	}
	

	public function edit()
	{
		if($this->session->userdata('user_id')){
			if($this->input->get('id')){
				$data['advertisement']=$this->Admin_model->getData('advertise_mst',array('id'=>$this->input->get('id'),'status'=>'Y'));
				$this->load->view('admin/includes/header');
				$this->load->view('admin/update-advertisement',$data);
				$this->load->view('admin/includes/footer');

			}else{
				if($this->input->post('update_Advertisement')){
					$id = $this->input->post('id');
					$single = $this->Admin_model->getData('advertise_mst',array('id'=>$id));
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
							$temp = $this->Admin_model->updateValue(array('vacancy_details'=>$vacancyDetail),'advertise_mst',array('id'=>$this->input->post('id')));
							($temp)?unlink($oldVacancyDetail):'';
						}else{
							$this->session->set_flashdata('errors', $this->upload->display_errors());
							redirect('admin/advertisement/edit?id='.$id);
						}
					}
					if (isset($_FILES['guidelines']) && !empty($_FILES['guidelines']['name'])) {
						if ($this->upload->do_upload('guidelines')) {
							$imageData1 = $this->upload->data(); 
							$guidelines = $dir.$imageData1['file_name'];
							$temp1 = $this->Admin_model->updateValue(array('guideline'=>$guidelines),'advertise_mst',array('id'=>$this->input->post('id')));
							($temp1)?unlink($oldGuideline):'';
						}else{
							$this->session->set_flashdata('errors', $this->upload->display_errors());
							redirect('admin/advertisement/edit?id='.$id);
						}
					}
					
					$data = array('date'=>$this->input->post('date'),'vacancy'=>$this->input->post('vacancy'),'vacancy_description'=>$this->input->post('vacancyDescription'),'important_content'=>$this->input->post('important'),'status'=>'Y','job_status'=>$this->input->post('job_status'),'update_date'=>date("Y-m-d H:i:s"));
					$this->Admin_model->updateValue($data,'advertise_mst',array('id'=>$this->input->post('id')));
					$this->session->set_flashdata('success', 'Updated Successfully');
					redirect('admin/advertisement/');
				}

			}

		}else{
			redirect('admin');
		}
	}
	public function delete()
	{
		if($this->session->userdata('user_id')){
			if($this->input->get('id')){
				$this->Admin_model->updateValue(array('delete_status'=>1),'application_mst',array('id'=>$this->input->get('id')));
				$this->session->set_flashdata('success', 'Deleted Successfully');
				redirect('admin/application');
			}else{
				$this->session->set_flashdata('errors', 'Error occurred!!');
				redirect('admin/application/');
			}
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
					$education_data_update = $this->Common_model->update_data('application_mst',array('id'=>$this->input->post('id')),$update_date);
					redirect('admin/application');
				}else{
					redirect('admin/application');
				}
				
			}else{
				$id = $this->input->get('id');
				$data['user_details'] = $this->Common_model->get_single('job_users_mst', array('id'=>$id));
				$data['application'] = $this->Common_model->get_single('application_mst', array('id'=>$id));
				$applicationNo = $data['application']->application_no;
				$data['personal_data'] = $this->Common_model->get_single('personal_mst', array('application_no'=>$data['application']->application_no));
				$data['education']=$this->Common_model->getAll('educational_mst',array('application_no'=>$applicationNo,'status'=>'Y'),'id','ASC','','');
				$data['professional'] = $this->Common_model->getAll('professional_mst',array('application_no'=>$applicationNo,'status'=>'Y'),'id','ASC','','');
				$data['employment'] = $this->Common_model->getAll('employment_mst',array('application_no'=>$applicationNo,'status'=>'Y'),'id','ASC','','');
				$data['others'] = $this->Common_model->get_single('others_details_mst',array('application_no'=>$applicationNo));
				$data['summary_mst'] = $this->Common_model->get_single('summary_mst',array('application_no'=>$applicationNo));
				$data['summary_hq_mst'] = $this->Common_model->get_single('summary_hq_mst',array('application_no'=>$applicationNo));
				$data['summary_eq_mst'] = $this->Common_model->get_single('summary_eq_mst',array('application_no'=>$applicationNo));
				$this->load->view('admin/includes/header');
				$this->load->view('admin/recruitment/application-details',$data); 
				$this->load->view('admin/includes/footer');
			}
			
		}else{
			redirect('admin');
		}

	}
}
