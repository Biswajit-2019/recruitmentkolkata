<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		if(!$this->session->userdata('logged_in')) {
			redirect();
		} 
      }

	public function index()
	{
		redirect('dashboard');
	}
	public function application_form()
	{
		
		//session_destroy();
		
		if($this->session->userdata('applicationNo')){
			$applicationNo = $this->session->userdata('applicationNo');
			$data['personal_data'] = $this->Common_model->get_single('personal_mst', array('application_no'=>$applicationNo));
			

			$data['education']=$this->Common_model->getAll('educational_mst',array('application_no'=>$applicationNo,'status'=>'Y'),'id','ASC','','');
			$data['professional'] = $this->Common_model->getAll('professional_mst',array('application_no'=>$applicationNo,'status'=>'Y'),'id','ASC','','');
			$data['employment'] = $this->Common_model->getAll('employment_mst',array('application_no'=>$applicationNo,'status'=>'Y'),'id','ASC','','');
			$data['others'] = $this->Common_model->get_single('others_details_mst',array('application_no'=>$applicationNo));
		}else{
			$data['personal_data'] = '';
			$data['education'] = array();
			$data['professional'] = array();
			$data['employment'] = array();
			$data['others'] = '';
		}
		$data['metaTitle']='Application Form';
		$data['metaKeywords']='Application Form';
		$data['metaDescription']='Application Form';
		$this->load->view('includes-recruitment/user-dash-header',$data);
		$this->load->view('recruitment/application-form',$data);
		$this->load->view('includes-recruitment/footer');
	}
	public function create_application()
	{
		if($this->session->userdata('applicationNo')){
			$applicationNo = $this->session->userdata('applicationNo');
			$single_personal_data = $this->Common_model->get_single('personal_mst', array('application_no'=>$applicationNo));
			$single_others_data = $this->Common_model->get_single('others_details_mst', array('application_no'=>$applicationNo));
		}else{
			$applicationNo = '';
			$single_personal_data = '';
			$single_others_data = '';
		}
		$data = array();
		$errorMessage = array();
		$multipleErrorMessage = array();
		$this->form_validation->set_error_delimiters('', '');
		(isset($_POST['advertiseNo']))?$this->form_validation->set_rules('advertiseNo', 'Advt. No.', 'trim|required'):'';
		(isset($_POST['postFor']))?$this->form_validation->set_rules('postFor', 'Post Applied For', 'trim|required'):'';
		(isset($_POST['discipline']))?$this->form_validation->set_rules('discipline', 'Discipline', 'trim|required'):'';
		(isset($_POST['postCode']))?$this->form_validation->set_rules('postCode', 'Post Code', 'trim|required'):'';
		(isset($_POST['name']))?$this->form_validation->set_rules('name', 'Name', 'trim|required'):'';
		(isset($_POST['dateOfBirth']))?$this->form_validation->set_rules('dateOfBirth', 'Date of Birth', 'trim|required'):'';
		(isset($_POST['closingDate']))?$this->form_validation->set_rules('closingDate', 'Age as on closing date', 'trim|required'):'';
		(isset($_POST['maritalStatus']))?$this->form_validation->set_rules('maritalStatus', 'Marital Status', 'trim|required'):'';
		(isset($_POST['nationality']))?$this->form_validation->set_rules('nationality', 'Nationality', 'trim|required'):'';
		
		
		(isset($_POST['address']))?$this->form_validation->set_rules('address', 'Address ', 'trim|required'):'';
		(isset($_POST['permanentAddress']))?$this->form_validation->set_rules('permanentAddress', 'Permanent Address', 'trim|required'):'';

		
		//(isset($_POST['refereesName']))?$this->form_validation->set_rules('refereesName', 'refereesName', 'trim|required'):'';
		//(isset($_POST['refereesAddress']))?$this->form_validation->set_rules('refereesAddress', 'refereesAddress', 'trim|required'):'';
		//(isset($_POST['refereesName1']))?$this->form_validation->set_rules('refereesName1', 'refereesName', 'trim|required'):'';
		//(isset($_POST['refereesAddress1']))?$this->form_validation->set_rules('refereesAddress1', 'refereesAddress', 'trim|required'):'';
		

		

		if(empty($single_personal_data->birth_date_proof)){
			(isset($_FILES['birthDateProof']) && !empty($_FILES['birthDateProof']['name']))?'':$this->form_validation->set_rules('birthDateProof', 'Upload', 'trim|required');
		}
		if(empty($single_personal_data->user_image)){
			(isset($_FILES['userImage']) && !empty($_FILES['userImage']['name']))?'':$this->form_validation->set_rules('userImage', 'userImage', 'trim|required');
		}
		
		
		/*if(empty($single_others_data->refereesEmployProof)){
			(isset($_FILES['refereesEmployProof']) && !empty($_FILES['refereesEmployProof']['name']))?'':$this->form_validation->set_rules('refereesEmployProof', 'refereesEmployProof', 'trim|required');
		}*/
		/*if(empty($single_others_data->refereesEmployProof1)){
			(isset($_FILES['refereesEmployProof1']) && !empty($_FILES['refereesEmployProof1']['name']))?'':$this->form_validation->set_rules('refereesEmployProof1', 'refereesEmployProof', 'trim|required');
		}*/
		if(empty($single_others_data->signature)){
			(isset($_FILES['signature']) && !empty($_FILES['signature']['name']))?'':$this->form_validation->set_rules('signature', 'signature', 'trim|required');
		}
		

		$education = $this->input->post('education');

		$professionalTraining = $this->input->post('professionalTraining');
		$employmentRecord = $this->input->post('employmentRecord');

		///////////////////////  Educational Qualifications Validation STARTS   ///////////////////////////////////////
		if(!empty($education))
		{

			foreach($education as $key => $value){
				 $this->form_validation->set_rules('education['.$key.'][examPassed]', 'examPassed', 'required|trim');
				 $this->form_validation->set_rules('education['.$key.'][examBoard]', 'examBoard', 'required|trim');
				 $this->form_validation->set_rules('education['.$key.'][yearOfEnrolment]', 'yearOfEnrolment', 'required|trim');
				 $this->form_validation->set_rules('education['.$key.'][yearOfCompletion]', 'yearOfCompletion', 'required|trim');
				 $this->form_validation->set_rules('education['.$key.'][subjectDegreeAwarded]', 'subjectDegreeAwarded', 'required|trim');
				 $this->form_validation->set_rules('education['.$key.'][specialisationAdvt]', 'specialisationAdvt', 'required|trim');
				 $this->form_validation->set_rules('education['.$key.'][percentageOfMarks]', 'percentageOfMarks', 'required|trim');
				 $this->form_validation->set_rules('education['.$key.'][division]', 'division', 'required|trim');
				 $this->form_validation->set_rules('education['.$key.'][rankPosotionInUniv]', 'rankPosotionInUniv', 'required|trim');
				 $this->form_validation->set_rules('education['.$key.'][rankPosotionInUniv]', 'rankPosotionInUniv', 'required|trim');

				 $single_education_data = $this->Common_model->get_single('educational_mst', array('application_no'=>$applicationNo,'key'=>$key));
				if(empty($single_education_data->certificate)){
					 (isset($_FILES['educationCertificate']) && !empty($_FILES['educationCertificate']['name'][$key]))? '': $this->form_validation->set_rules('educationCertificate['.$key.']', 'educationCertificate', 'required|trim');
				}
				
				
			}
		}
		///////////////////////  Educational Qualifications Validation ENDS   ///////////////////////////////////////


		if ($this->form_validation->run() == TRUE) {
			if($this->session->userdata('applicationNo')){
				$applicationNo = $this->session->userdata('applicationNo');
				$applicationCount = $this->Common_model->numrowsDbQuery("SELECT * FROM  application_mst WHERE application_no='$applicationNo'");
				if($applicationCount==0){
					$application_mst_data = array('user_id'=>$this->session->userdata('id'),'advertise_id'=>$this->input->post('advertiseNo'),'application_no'=>$applicationNo,'application_status'=>'0','status'=>'N','delete_status'=>0,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));

				$application_mst_insert =  $this->Common_model->insertData('application_mst',$application_mst_data);

				}
			}else{
				$applicationNo = mt_rand(10000000, 99999999);
				//$applicationNo = rand();
				$applicationArray = array('applicationNo'=>$applicationNo);
				$this->session->set_userdata($applicationArray);
				$application_mst_data = array('user_id'=>$this->session->userdata('id'),'advertise_id'=>$this->input->post('advertiseNo'),'application_no'=>$applicationNo,'application_status'=>'0','status'=>'N','delete_status'=>0,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));

				$application_mst_insert =  $this->Common_model->insertData('application_mst',$application_mst_data);
			}

			$data['status']='Yes';
			$target_dir = "public/uploaded/".$applicationNo;
			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}
			$imageExts = array("png", "jpg", "jpeg","pdf");
			///////////////////////  Birth Date Proof Image Check STARTS   ///////////////////////////////////////
			if(isset($_FILES['userImage']) && !empty($_FILES['userImage']['name'])){
				$config['upload_path'] = $target_dir;
				$config['allowed_types'] = 'png|jpg|jpeg';
				//$config['max_size'] = '100';
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('userImage')){
					$uploadData1 = $this->upload->data();
					$userImage = $target_dir.'/'.$uploadData1['file_name'];
					if(!empty($single_personal_data)){
						if (is_file(FCPATH.'/'.$single_personal_data->user_image)) {
							unlink(FCPATH.'/'.$single_personal_data->user_image);
						}
					}
				}else{
					$data['status']='No';
					$data['message']['userImage'] = $this->upload->display_errors('', '');
				}
			}else{
				if(empty($single_personal_data->user_image)){
					$userImage = '';
				}else{
					$userImage = $single_personal_data->user_image;
				}	
				
			}
			///////////////////////  Birth Date Proof Image Check ENDS   ///////////////////////////////////////

			///////////////////////  Birth Date Proof Image Check STARTS   ///////////////////////////////////////
			if(isset($_FILES['birthDateProof']) && !empty($_FILES['birthDateProof']['name'])){
				$config['upload_path'] = $target_dir;
				$config['allowed_types'] = 'pdf';
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('birthDateProof')){
					$uploadData2 = $this->upload->data();
					$birthDateProofImage = $target_dir.'/'.$uploadData2['file_name'];
					if(!empty($single_personal_data)){
						if (is_file(FCPATH.'/'.$single_personal_data->birth_date_proof)) {
							unlink(FCPATH.'/'.$single_personal_data->birth_date_proof);
						}
					}
				}else{
					$data['status']='No';
					$data['message']['birthDateProof'] = $this->upload->display_errors('', '');
				}

			}else{
				
				if(empty($single_personal_data->birth_date_proof)){
					$birthDateProofImage = '';
				}else{
					$birthDateProofImage = $single_personal_data->birth_date_proof;
				}	
			}
			///////////////////////  Birth Date Proof Image Check ENDS   ///////////////////////////////////////

			///////////////////////  Caste Certificate Image Check STARTS   //////////////////////////////
			if(isset($_FILES['casteAttachFile']) && !empty($_FILES['casteAttachFile']['name'])){
				$castCertificateStatus = fileuplodCi('casteAttachFile',$target_dir);
				$extension = strtolower(pathinfo($castCertificateStatus, PATHINFO_EXTENSION));
				if(in_array($extension,$imageExts)){
					$casteAttachFile = $castCertificateStatus;
					if(!empty($single_personal_data)){
						if (is_file(FCPATH.'/'.$single_personal_data->caste_attach_file)) {
							unlink(FCPATH.'/'.$single_personal_data->caste_attach_file);
						}
					}
					
				}else{
					$data['status']='No';
					$data['message']['casteAttachFile'] = $castCertificateStatus;
				}
			}else{
				if(empty($single_personal_data->caste_attach_file)){
					$casteAttachFile = '';
				}else{
					$casteAttachFile = $single_personal_data->caste_attach_file;
				}	
				
			}
			///////////////////////  Caste Certificate Image Check ENDS   //////////////////////////////

			///////////////////////  Attach Noc Image Check STARTS   ///////////////////////////////////////
			if(isset($_FILES['attachNocFile']) && !empty($_FILES['attachNocFile']['name'])){
				$attachNocFileStatus = fileuplodCi('attachNocFile', $target_dir);
				$extension = strtolower(pathinfo($attachNocFileStatus, PATHINFO_EXTENSION));
				if(in_array($extension,$imageExts)){
					$attachNocImage = $attachNocFileStatus;
					if(!empty($single_others_data)){
						if (is_file(FCPATH.'/'.$single_others_data->attachNocFile)) {
							unlink(FCPATH.'/'.$single_others_data->attachNocFile);
						}
					}
					
				}else{
					$data['status'] ='No';
					$data['message']['attachNocFile'] = $attachNocFileStatus;
				}
			}else{
				
				if(empty($single_others_data->attachNocFile)){
					$attachNocImage = '';
				}else{
					$attachNocImage = $single_others_data->attachNocFile;
				}	
			}
			/////////////////////// Attach Noc Image Check ENDS   ///////////////////////////////////////

			/////////////////////// Referees Employ Proof  Image Check STARTS   ///////////////////////////////////////
			if(isset($_FILES['refereesEmployProof']) && !empty($_FILES['refereesEmployProof']['name'])){
				$refereesEmployProofStatus = fileuplodCi('refereesEmployProof', $target_dir);
				$extension = strtolower(pathinfo($refereesEmployProofStatus, PATHINFO_EXTENSION));
				if(in_array($extension,$imageExts)){
					$refereesEmployProofImage = $refereesEmployProofStatus;
					if(!empty($single_others_data)){
						if (is_file(FCPATH.'/'.$single_others_data->refereesEmployProof)) {
							unlink(FCPATH.'/'.$single_others_data->refereesEmployProof);
						}
					}
					
				}else{
					$data['status'] ='No';
					$data['message']['refereesEmployProof'] = $refereesEmployProofStatus;
				}
			}else{
				
				if(empty($single_others_data->refereesEmployProof)){
					$refereesEmployProofImage = '';
				}else{
					$refereesEmployProofImage = $single_others_data->refereesEmployProof;
				}
			}
			///////////////////////Referees Employ Proof Image Check ENDS ///////////////////////////////////////

			/////////////////////// Referees Employ1 Proof  Image Check STARTS   ///////////////////////////////////////
			if(isset($_FILES['refereesEmployProof1']) && !empty($_FILES['refereesEmployProof1']['name'])){
				$refereesEmployProofStatus1 = fileuplodCi('refereesEmployProof1', $target_dir);
				$extension = strtolower(pathinfo($refereesEmployProofStatus1, PATHINFO_EXTENSION));
				if(in_array($extension,$imageExts)){
					$refereesEmployProofImage1 = $refereesEmployProofStatus1;
					if(!empty($single_others_data)){
						if (is_file(FCPATH.'/'.$single_others_data->refereesEmployProof1)) {
							unlink(FCPATH.'/'.$single_others_data->refereesEmployProof1);
						}
					}
					
				}else{
					$data['status'] ='No';
					$data['message']['refereesEmployProof1'] = $refereesEmployProofStatus1;
				}
			}else{
				
				if(empty($single_others_data->refereesEmployProof1)){
					$refereesEmployProofImage1 = '';
				}else{
					$refereesEmployProofImage1 = $single_others_data->refereesEmployProof1;
				}
			}
			///////////////////////Referees Employ Proof Image Check ENDS ///////////////////////////////////////

			///////////////////////  Signature Image  Check STARTS   ///////////////////////////////////////
			if(isset($_FILES['signature']) && !empty($_FILES['signature']['name'])){
				$signatureStatus = fileuplodCi('signature', $target_dir); 
				$extension = strtolower(pathinfo($signatureStatus, PATHINFO_EXTENSION));
				if(in_array($extension,$imageExts)){
					$signatureImage = $signatureStatus;
					if(!empty($single_others_data)){
						if (is_file(FCPATH.'/'.$single_others_data->signature)) {
							unlink(FCPATH.'/'.$single_others_data->signature);
						}
					}
					
				}else{
					$data['status']='No';
					$data['message']['signature'] = $signatureStatus;
				}
			}else{
				
				if(empty($single_others_data->signature)){
					$signatureImage = '';
				}else{
					$signatureImage = $single_others_data->signature;
				}
			}
			///////////////////////  Signature Image  Check ENDS   ///////////////////////////////////////


			


			///////////////////////  Educational Qualifications Insert STARTS   ///////////////////////////////////////
			if(!empty($education))
			{
				foreach($education as $key => $value){
					$educationCount = $this->Common_model->getNumrows('educational_mst',array('application_no'=>$applicationNo,'key'=>$key));
					$single_education_data = $this->Common_model->get_single('educational_mst', array('application_no'=>$applicationNo,'key'=>$key));
					if(!empty($_FILES['educationCertificate']['name'][$key])){
						$_FILES['file']['name'] = $_FILES['educationCertificate']['name'][$key];
						$_FILES['file']['type'] = $_FILES['educationCertificate']['type'][$key];
						$_FILES['file']['tmp_name'] = $_FILES['educationCertificate']['tmp_name'][$key];
						$_FILES['file']['error'] = $_FILES['educationCertificate']['error'][$key];
						$_FILES['file']['size'] = $_FILES['educationCertificate']['size'][$key];
						$config['upload_path'] = $target_dir; 
						$config['allowed_types'] = 'pdf';
						//$config['max_size'] = '5000';
						$this->load->library('upload',$config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('file')){
							$uploadData = $this->upload->data();
							$value['certificate'] = $target_dir.'/'.$uploadData['file_name'];
							if(!empty($single_education_data)){
								if (is_file(FCPATH.'/'.$single_education_data->certificate)) {
									unlink(FCPATH.'/'.$single_education_data->certificate);
								}
							}
							
						}else{
							$data['status']='No';
							$data['multipleErrorMessage']['educationCertificate['.$key.']'] = $this->upload->display_errors('', '');
						}
					}else{
						$value['certificate'] = $single_education_data->certificate;
					}
					$value['key'] = $key;
					$value['application_no'] = $applicationNo;
					if($educationCount>0){
						$education_data_update = $this->Common_model->update_data('educational_mst',array('application_no'=>$applicationNo,'key'=>$key),$value);
					}else{
						$personal_data_insert = $this->Common_model->insertData('educational_mst',$value);
					}
					
				}
			}
			///////////////////////  Educational Qualifications Insert ENDSS  ///////////////////////////////////////

			///////////////////////  Professional Training Insert STARTS   ///////////////////////////////////////
			if(!empty($professionalTraining))
			{
				
				foreach($professionalTraining as $key => $value){
					$professionalTrainingCount = $this->Common_model->getNumrows('professional_mst',array('application_no'=>$applicationNo,'key'=>$key));
					$single_professional_data = $this->Common_model->get_single('professional_mst', array('application_no'=>$applicationNo,'key'=>$key));
					if(!empty($_FILES['professionalTrainingCertificate']['name'][$key])){
						$_FILES['file']['name'] = $_FILES['professionalTrainingCertificate']['name'][$key];
						$_FILES['file']['type'] = $_FILES['professionalTrainingCertificate']['type'][$key];
						$_FILES['file']['tmp_name'] = $_FILES['professionalTrainingCertificate']['tmp_name'][$key];
						$_FILES['file']['error'] = $_FILES['professionalTrainingCertificate']['error'][$key];
						$_FILES['file']['size'] = $_FILES['professionalTrainingCertificate']['size'][$key];
						$config['upload_path'] = $target_dir; 
						$config['allowed_types'] = 'pdf';
						//$config['max_size'] = '5000';
						$this->load->library('upload',$config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('file')){
							$uploadData = $this->upload->data();
							$value['certificate'] = $target_dir.'/'.$uploadData['file_name'];
							if(!empty($single_professional_data)){
								if (is_file(FCPATH.'/'.$single_professional_data->certificate)) {
									unlink(FCPATH.'/'.$single_professional_data->certificate);
								}
							}
							
						}else{
							$data['status']='No';
							$data['multipleErrorMessage']['professionalTrainingCertificate['.$key.']'] = $this->upload->display_errors('', '');
						}
					}else{
						
						if(empty($single_professional_data->certificate)){
							$value['certificate'] = '';
						}else{
							$value['certificate'] = $single_professional_data->certificate;
						}
					}
					
					
					if($professionalTrainingCount>0){
						$value['key'] = $key;
						$value['application_no'] = $applicationNo;
						$professional_data_update = $this->Common_model->update_data('professional_mst',array('application_no'=>$applicationNo,'key'=>$key),$value);
					}else{
						
						if(count(array_filter($value))>0) {
							$value['key'] = $key;
							$value['application_no'] = $applicationNo;
							$personal_data_insert = $this->Common_model->insertData('professional_mst',$value);
						}
						
					}
					
				}
			}
			///////////////////////  Professional Training Insert ENDSS  ///////////////////////////////////////

			///////////////////////  Employment Record Insert STARTS   ///////////////////////////////////////
			if(!empty($employmentRecord))
			{
				foreach($employmentRecord as $key => $value){
					$employmentRecordCount = $this->Common_model->getNumrows('employment_mst',array('application_no'=>$applicationNo,'key'=>$key));
					$single_employment_data = $this->Common_model->get_single('employment_mst', array('application_no'=>$applicationNo,'key'=>$key));

					if(!empty($_FILES['employmentRecordCertificate']['name'][$key])){
						$_FILES['file']['name'] = $_FILES['employmentRecordCertificate']['name'][$key];
						$_FILES['file']['type'] = $_FILES['employmentRecordCertificate']['type'][$key];
						$_FILES['file']['tmp_name'] = $_FILES['employmentRecordCertificate']['tmp_name'][$key];
						$_FILES['file']['error'] = $_FILES['employmentRecordCertificate']['error'][$key];
						$_FILES['file']['size'] = $_FILES['employmentRecordCertificate']['size'][$key];
						$config['upload_path'] = $target_dir; 
						$config['allowed_types'] = 'pdf';
						//$config['max_size'] = '5000';
						$this->load->library('upload',$config);
						$this->upload->initialize($config);
						if($this->upload->do_upload('file')){
							$uploadData = $this->upload->data();
							$value['certificate'] = $target_dir.'/'.$uploadData['file_name'];
							if(!empty($single_employment_data)){
								if (is_file(FCPATH.'/'.$single_employment_data->certificate)) {
									unlink(FCPATH.'/'.$single_employment_data->certificate);
								}
							}
							
						}else{
							$data['status']='No';
							$data['multipleErrorMessage']['employmentRecordCertificate['.$key.']'] = $this->upload->display_errors('', '');
						}
					}else{
						

						if(empty($single_employment_data->certificate)){
							$value['certificate'] = '';
						}else{
							$value['certificate'] = $single_employment_data->certificate;
						}
					}
					
					if($employmentRecordCount>0){
						$value['key'] = $key;
						$value['application_no'] = $applicationNo;
						$employment_data_update = $this->Common_model->update_data('employment_mst',array('application_no'=>$applicationNo,'key'=>$key),$value);
					}else{
						if(count(array_filter($value))>0) {
							$value['key'] = $key;
							$value['application_no'] = $applicationNo;
							$employment_data_insert = $this->Common_model->insertData('employment_mst',$value);
						}
						
					}
					
				}
			}

			///////////////////////  Employment Record Insert ENDSS  ///////////////////////////////////////
			
			

				$dateOfBirth = date_format(date_create_from_format('d-m-Y', $this->input->post('dateOfBirth')), 'Y-m-d');
				$personal_data = array('application_no'=>$applicationNo,'advertise_no'=>$this->input->post('advertiseNo'),'post_for'=>$this->input->post('postFor'),'discipline'=>$this->input->post('discipline'),'post_code'=>$this->input->post('postCode'),'user_image'=>$userImage,'user_name'=>$this->input->post('name'),'father_name'=>$this->input->post('fatherName'),'mother_name'=>$this->input->post('motherName'),'date_of_birth'=>$dateOfBirth,'closing_date'=>$this->input->post('closingDate'),'birth_date_proof'=>$birthDateProofImage,'gender'=>$this->input->post('sex'),'marital_status'=>$this->input->post('maritalStatus'),'nationality'=>$this->input->post('nationality'),'caste'=>$this->input->post('category'),'caste_attach_file'=>$casteAttachFile,'central_state_govt'=>$this->input->post('centralStateGovt'),'address'=>$this->input->post('address'),'permanent_address'=>$this->input->post('permanentAddress'),'nearest_railway_station'=>$this->input->post('nearestRailwayStation'));
				$personalDataCount = $this->Common_model->getNumrows('personal_mst',array('application_no'=>$applicationNo));

				if($personalDataCount>0){
					$personal_data_update = $this->Common_model->update_data('personal_mst',array('application_no'=>$this->session->userdata('applicationNo')),$personal_data);
				}else{
					$personal_data_insert = $this->Common_model->insertData('personal_mst',$personal_data);
				}

			

			
				$otherData = array('application_no'=>$applicationNo,'presentBasicPay'=>$this->input->post('presentBasicPay'),'totalEmoluments'=>$this->input->post('totalEmoluments'),'presentPostHeld'=>$this->input->post('presentPostHeld'),'publicSectorUndertaking'=>$this->input->post('publicSectorUndertaking'),'attachNocFile'=>$attachNocImage,'srNo'=>$this->input->post('srNo'),'particulars'=>$this->input->post('particulars'),'nameOfPosts'=>$this->input->post('nameOfPosts'),'dateOfInterview'=>$this->input->post('dateOfInterview'),'result'=>$this->input->post('result'),'nameOfTheRelative'=>$this->input->post('nameOfTheRelative'),'relationship'=>$this->input->post('relationship'),'labEmployed'=>$this->input->post('labEmployed'),'postHeld'=>$this->input->post('postHeld'),'refereesName'=>$this->input->post('refereesName'),'refereesAddress'=>$this->input->post('refereesAddress'),'refereesEmployProof'=>$refereesEmployProofImage,'refereesName1'=>$this->input->post('refereesName1'),'refereesAddress1'=>$this->input->post('refereesAddress1'),'refereesEmployProof1'=>$refereesEmployProofImage1,'otherInformation'=>$this->input->post('otherInformation'),'signature'=>$signatureImage,'conditionAccept'=>$this->input->post('conditionAccept'));
				$otherDataCount = $this->Common_model->getNumrows('others_details_mst',array('application_no'=>$applicationNo));
				if($otherDataCount>0){
					$other_data_update = $this->Common_model->update_data('others_details_mst',array('application_no'=>$applicationNo),$otherData);
				}else{
					$other_data_insert = $this->Common_model->insertData('others_details_mst',$otherData);
				}

			
			
			
			
		}else{
			$data['status']='No';
			$errorMessage = array('advertiseNo' => form_error('advertiseNo'),'postFor'=>form_error('postFor'),'discipline'=>form_error('discipline'),'postCode'=>form_error('postCode'),'name'=>form_error('name'),'dateOfBirth'=>form_error('dateOfBirth'),'closingDate'=>form_error('closingDate'),'maritalStatus'=>form_error('maritalStatus'),'nationality'=>form_error('nationality'),'address'=>form_error('address'),'permanentAddress'=>form_error('permanentAddress'),'birthDateProof'=>form_error('birthDateProof'),'userImage'=>form_error('userImage'),'attachNoc'=>form_error('attachNoc'),'publicSectorUndertaking'=>form_error('publicSectorUndertaking'),'signature'=>form_error('signature'));


			 if(!isset($_POST['sex'])){$data['radioErrorMessage']['sex'] = 'This field is required';}else{$data['radioErrorMessage']['sex'] = '';}

			  

			///////////////////// Educational Qualifications Error Message STARTS   ///////////////////////////

			if(!empty($education))
			{
				foreach($education as $key => $value){
					$multipleErrorMessage['education['.$key.'][examPassed]']=form_error('education['.$key.'][examPassed]');
					$multipleErrorMessage['education['.$key.'][examBoard]']=form_error('education['.$key.'][examBoard]');
					$multipleErrorMessage['education['.$key.'][yearOfEnrolment]']=form_error('education['.$key.'][yearOfEnrolment]');
					$multipleErrorMessage['education['.$key.'][yearOfCompletion]']=form_error('education['.$key.'][yearOfCompletion]');
					$multipleErrorMessage['education['.$key.'][subjectDegreeAwarded]']=form_error('education['.$key.'][subjectDegreeAwarded]');
					$multipleErrorMessage['education['.$key.'][specialisationAdvt]']=form_error('education['.$key.'][specialisationAdvt]');
					$multipleErrorMessage['education['.$key.'][percentageOfMarks]']=form_error('education['.$key.'][percentageOfMarks]');
					$multipleErrorMessage['education['.$key.'][division]']=form_error('education['.$key.'][division]');
					$multipleErrorMessage['education['.$key.'][rankPosotionInUniv]']=form_error('education['.$key.'][rankPosotionInUniv]');
					$multipleErrorMessage['educationCertificate['.$key.']']=form_error('educationCertificate['.$key.']');
					
				}
				$data['multipleErrorMessage']=$multipleErrorMessage;
			}
			///////////////////// Educational Qualifications Error Message ENDS   ///////////////////////////


			$data['message'] = $errorMessage;
			
		}
		//echo "<pre>";print_r($data);
		echo json_encode($data);
		
	}
	public function check_advt_no()
	{
		$advtNo = $_REQUEST['advertiseNo'];	
		$data = $this->Common_model->getAll('advertise_mst',array('advt_no'=>$advtNo),'','','','');
		//print_r($data);
		$count =  count($data);
		//$valid = true;
		if($count > 0){
			$valid = true;
		}
		else{
			$valid = false;
		}
		echo json_encode($valid);
		exit();
	}
	/*public function age_calculate()
	{
		$advertiseNo = $_REQUEST['advertiseNo'];
		$dateOfBirth = date_create($_REQUEST['dateOfBirth']);
		$whare = array('advt_no'=>$advertiseNo,'status'=>'Y');
		$advertiseCount = $this->Common_model->getNumrows('advertise_mst',$whare);
		if($advertiseCount>0){
			$single_education_data = $this->Common_model->get_single('advertise_mst',$whare);
			$closingDate = date_create($single_education_data->date);
			$diff = date_diff($dateOfBirth,$closingDate);
			$format = $diff->y.'-Years,'.$diff->m.'-Months,'.$diff->d.'-Days';
		}else{
			$format = '';
		}
		echo $format;
		
	}*/
	public function age_calculate()
	{
		$data = array();
		$advertiseNo = $_REQUEST['advertiseNo'];
		$userId = $this->session->userdata('id');
		$count = $this->Common_model->getNumrows('application_mst',array('advertise_id'=>$advertiseNo,'user_id'=>$userId,'status'=>'Y'));
		if($count>0){
			$data['status'] = 'Yes';
			$data['advertiseNoCheck'] = 'You have already applied.';
		}else{
			$data['status'] = 'No';
			$data['advertiseNoCheck'] = '';
			$dateOfBirth = date_create($_REQUEST['dateOfBirth']);
			$whare = array('advt_no'=>$advertiseNo,'status'=>'Y');
			$advertiseCount = $this->Common_model->getNumrows('advertise_mst',$whare);
			if($advertiseCount>0){
				$single_education_data = $this->Common_model->get_single('advertise_mst',$whare);
				$closingDate = date_create($single_education_data->date);
				$diff = date_diff($dateOfBirth,$closingDate);
				$format = $diff->y.'-Years,'.$diff->m.'-Months,'.$diff->d.'-Days';
			}else{
				$format = '';
			}
			$data['format'] = $format;
		}
		echo json_encode($data);
	}
	public function format_of_certificate()
	{
		$data['metaTitle']='Format Of Certificate';
		$data['metaKeywords']='Format Of Certificate';
		$data['metaDescription']='Format Of Certificate';
		$this->load->view('includes-recruitment/user-dash-header',$data);
		$this->load->view('recruitment/format_of_certificate',$data);
		$this->load->view('includes-recruitment/footer');
		
	}
	public function update_certificate_form()
	{
		if($this->session->userdata('applicationNo')){
			$this->form_validation->set_error_delimiters('', '');
			$applicationNo = $this->session->userdata('applicationNo');
			$applicationCount = $this->Common_model->getNumrows('application_mst',array('application_no'=>$applicationNo));
			if($applicationCount>0){
				$applicationDetails = $this->Common_model->get_single('application_mst', array('application_no'=>$applicationNo));
				$this->form_validation->set_rules('textid', 'textid', 'trim|required');
				
				if ($this->form_validation->run() == TRUE) {
					$target_dir = "public/uploaded/".$applicationNo;
					$imageExts = array("png", "jpg", "jpeg","pdf");
					if(isset($_FILES['formatOfCertificate']) && !empty($_FILES['formatOfCertificate']['name'])){
						$formatOfCertificateStatus = fileuplodCi('formatOfCertificate',$target_dir);
						$extension = strtolower(pathinfo($formatOfCertificateStatus, PATHINFO_EXTENSION));
						if(in_array($extension,$imageExts)){
							$certificateImage = $formatOfCertificateStatus;
							if(!empty($applicationDetails)){
								if (is_file(FCPATH.'/'.$applicationDetails->formatOfCertificate)) {
									unlink(FCPATH.'/'.$applicationDetails->formatOfCertificate);
								}
							}
							$data['status']= 'Yes';
							$application_update = $this->Common_model->update_data('application_mst',array('application_no'=>$applicationNo),array('formatOfCertificate'=>$certificateImage));

						}else{
							$data['status']= 'No';
							$data['message']['formatOfCertificate'] = $formatOfCertificateStatus;
						}
					}else{
						$data['status']= 'Yes';
						if(!empty($applicationDetails->formatOfCertificate)){
							$certificateImage = $applicationDetails->formatOfCertificate;
						}else{
							$certificateImage = '';
						}
						
						$application_update = $this->Common_model->update_data('application_mst',array('application_no'=>$applicationNo),array('formatOfCertificate'=>$certificateImage));
					}
				}else{
					$data['status']= 'No';
					$data['message']['formatOfCertificate'] = form_error('formatOfCertificate');
				}
			}
			

		}else{
			$data['status']= 'No';
			$data['message'][] = '';
		}
		echo json_encode($data);
	}
	
	public function ajax_multiple_file_check()
	{
		$fileName = key($_FILES);
		$target_dir = './public/uploaded/test';
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}
		$config['upload_path'] = $target_dir;
		if($fileName=='educationCertificate'){
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';
		}else{
			$config['allowed_types'] = 'pdf';
		}
		 
		 foreach ($_FILES[$fileName]['name'] as $i => $image) {
    		if(!empty($_FILES[$fileName]['name'][$i])){
    			 $_FILES['file']['name'] = $_FILES[$fileName]['name'][$i];
		          $_FILES['file']['type'] = $_FILES[$fileName]['type'][$i];
		          $_FILES['file']['tmp_name'] = $_FILES[$fileName]['tmp_name'][$i];
		          $_FILES['file']['error'] = $_FILES[$fileName]['error'][$i];
		          $_FILES['file']['size'] = $_FILES[$fileName]['size'][$i];
		  		  $this->load->library('upload',$config); 
		          if($this->upload->do_upload('file')){
		          	$uploadData = $this->upload->data();
		          	$devicePath = FCPATH . '/public/uploaded/test/';
		          	if (is_file($devicePath . '/' . $uploadData['file_name'])) {
						unlink($devicePath . '/' . $uploadData['file_name']);
					}
					$data = array();
					$data['status']='Yes';
					$data['message'] = '';
					echo json_encode($data);
		          }else{
					$data = array();
					$data['status']='No';
					$data['message'] =$this->upload->display_errors('', '');
					echo json_encode($data);
		          }
    		}
    	}
	}
	public function ajax_single_file_check()
	{
		$fileName = key($_FILES);
		$target_dir = './public/uploaded/test';
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}
		$config['upload_path'] = $target_dir;
		$config['file_name']   = time();
		if($fileName=='userImage'){
			$config['allowed_types'] = 'png|jpg|jpeg';
			$config['max_size'] = '100';
		}elseif ($fileName=='birthDateProof') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='casteAttachFile') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='attachNocFile') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='refereesEmployProof') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='refereesEmployProof1') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='certificate') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='hq_certificate') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='signature') {
			$config['allowed_types'] = 'png|jpg|jpeg';
			$config['max_size'] = '100';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';
		}elseif ($fileName=='formatOfCertificate') {
			$config['allowed_types'] = 'pdf';
			/*$config['max_size'] = '100';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';*/
		}else{
			$config['allowed_types'] = 'pdf';
		}
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload($fileName)) {
			$data = array();
			$data['status']='No';
			$data['message'] =$this->upload->display_errors('', '');
			unset($config);
			echo json_encode($data);
		}else{
			$uploadData = $this->upload->data();
          	$devicePath = FCPATH . '/public/uploaded/test/';
          	if (is_file($devicePath . '/' . $uploadData['file_name'])) {
				unlink($devicePath . '/' . $uploadData['file_name']);
			}
			$data = array();
			$data['status']='Yes';
			$data['message'] ='';
			unset($config);
			echo json_encode($data);
		}
	}
	

}
