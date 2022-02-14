<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summary extends CI_Controller {

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
			//print_r($_SESSION);
			if($this->session->userdata('applicationNo')){
				$applicationNo = $this->session->userdata('applicationNo');
				/*$data['completeStatus'] = $this->Common_model->numrowsDbQuery("SELECT * FROM  application_mst WHERE application_no='$applicationNo'  AND formatOfCertificate !=''");
				$data['personal_data'] = $this->Common_model->get_single('personal_mst', array('application_no'=>$applicationNo));
				$data['education'] = $this->Common_model->getAll('educational_mst',array('application_no'=>$applicationNo,'status'=>'Y'),'id','ASC','','');*/
				$data['completeStatus'] = $this->Common_model->numrowsDbQuery("SELECT * FROM  application_mst WHERE application_no='$applicationNo'");
				$data['personal_data'] = '';
				$data['education'] = array();
			}else{
				$data['completeStatus'] = 0;
				$data['personal_data'] = '';
				$data['education'] = array();
			}
			//print_r($data['education']);
			$data['metaTitle']='Summary';
			$data['metaKeywords']='Summary';
			$data['metaDescription']='Summary';
			$this->load->view('includes-recruitment/user-dash-header',$data);
			$this->load->view('recruitment/summary',$data);
			$this->load->view('includes-recruitment/footer');
			
		}
		public function update_summary_form()
		{
			$data = array();
			if($this->session->userdata('applicationNo')){
				$applicationNo = $this->session->userdata('applicationNo');
				$uploadeCertificateCount = $this->Common_model->numrowsDbQuery("SELECT * FROM  application_mst WHERE application_no='$applicationNo'");
				
			}else{
				$uploadeCertificateCount = 0;
			}
			if($uploadeCertificateCount>0){

				if($this->session->userdata('applicationNo')){
				$applicationNo = $this->session->userdata('applicationNo');
				$single_summary_data = $this->Common_model->get_single('summary_mst', array('application_no'=>$applicationNo));
				$single_application_data = $this->Common_model->get_single('application_mst', array('application_no'=>$applicationNo));
				$single_summary_eq_data = $this->Common_model->get_single('summary_eq_mst', array('application_no'=>$applicationNo));
				$single_summary_hq_data = $this->Common_model->get_single('summary_hq_mst', array('application_no'=>$applicationNo));
			}
			$this->form_validation->set_error_delimiters('', '');
			(isset($_POST['advertiseNo']))?$this->form_validation->set_rules('advertiseNo', 'Advt. No.', 'trim|required'):'';
			(isset($_POST['discipline']))?$this->form_validation->set_rules('discipline', 'Discipline', 'trim|required'):'';
			(isset($_POST['post']))?$this->form_validation->set_rules('post', 'Post Applied For', 'trim|required'):'';
			(isset($_POST['postCode']))?$this->form_validation->set_rules('postCode', 'Post Code', 'trim|required'):'';
			(isset($_POST['name']))?$this->form_validation->set_rules('name', 'Name', 'trim|required'):'';
			(isset($_POST['dateOfBirth']))?$this->form_validation->set_rules('dateOfBirth', 'DOB', 'trim|required'):'';
			(isset($_POST['closingDate']))?$this->form_validation->set_rules('closingDate', 'Age as on Closing Date:', 'trim|required'):'';
			(isset($_POST['nationality']))?$this->form_validation->set_rules('nationality', 'Nationality', 'trim|required'):'';
			
			(isset($_POST['closingDate']))?$this->form_validation->set_rules('closingDate', 'Age as on Closing Date', 'trim|required'):'';

			(isset($_POST['hq_examUniversityRank']))?$this->form_validation->set_rules('hq_examUniversityRank', 'Exam University Rank', 'trim|required'):'';
			(isset($_POST['hq_university']))?$this->form_validation->set_rules('hq_university', 'University', 'trim|required'):'';
			(isset($_POST['hq_subject']))?$this->form_validation->set_rules('hq_subject', 'Subject', 'trim|required'):'';
			(isset($_POST['hq_month']))?$this->form_validation->set_rules('hq_month', 'Month', 'trim|required'):'';
			(isset($_POST['hq_year']))?$this->form_validation->set_rules('hq_year', 'Year', 'trim|required'):'';
			(isset($_POST['hq_average']))?$this->form_validation->set_rules('hq_average', '%age', 'trim|required'):'';
			(isset($_POST['hq_grade']))?$this->form_validation->set_rules('hq_grade', 'Div/Gde', 'trim|required'):'';

			(isset($_POST['examUniversityRank']))?$this->form_validation->set_rules('examUniversityRank', 'Exam University Rank', 'trim|required'):'';
			(isset($_POST['university']))?$this->form_validation->set_rules('university', 'University', 'trim|required'):'';
			(isset($_POST['subject']))?$this->form_validation->set_rules('subject', 'Subject', 'trim|required'):'';
			(isset($_POST['month']))?$this->form_validation->set_rules('month', 'Month', 'trim|required'):'';
			(isset($_POST['year']))?$this->form_validation->set_rules('year', 'Year', 'trim|required'):'';
			(isset($_POST['average']))?$this->form_validation->set_rules('average', '%age', 'trim|required'):'';
			(isset($_POST['grade']))?$this->form_validation->set_rules('grade', 'Div/Gde', 'trim|required'):'';


			
			
			(isset($_POST['postalAddressCommunication']))?$this->form_validation->set_rules('postalAddressCommunication', 'Postal Address(Form Communication)', 'trim|required'):'';
			
			(isset($_POST['pin']))?$this->form_validation->set_rules('pin', 'Pin', 'trim|required'):'';
			
			(isset($_POST['mobile']))?$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required'):'';
			
			(isset($_POST['email']))?$this->form_validation->set_rules('email', 'Email', 'trim|required'):'';



			if(empty($single_summary_eq_data->certificate)){
				(isset($_FILES['certificate']) && !empty($_FILES['certificate']['name']))?'':$this->form_validation->set_rules('certificate', 'certificate', 'trim|required');
			}
			if(empty($single_summary_hq_data->certificate)){
				(isset($_FILES['hq_certificate']) && !empty($_FILES['hq_certificate']['name']))?'':$this->form_validation->set_rules('hq_certificate', 'certificate', 'trim|required');
			}

			if ($this->form_validation->run() == TRUE) {
				$target_dir = "public/uploaded/".$applicationNo;
				if (!file_exists($target_dir)) {
					mkdir($target_dir, 0777, true);
				}
			$imageExts = array("png", "jpg", "jpeg","pdf");
				///////////////////////  certificate  Check STARTS   ///////////////////////////////////////
			if(isset($_FILES['certificate']) && !empty($_FILES['certificate']['name'])){
				$certificateStatus = fileuplodCi('certificate', $target_dir); 
				$extension = strtolower(pathinfo($certificateStatus, PATHINFO_EXTENSION));
				if(in_array($extension,$imageExts)){
					$certificateImage = $certificateStatus;
					if(!empty($single_summary_eq_data)){
						if (is_file(FCPATH.'/'.$single_summary_eq_data->certificate)) {
							unlink(FCPATH.'/'.$single_summary_eq_data->certificate);
						}
					}
					
				}else{
					$data['status']='No';
					$data['message']['certificate'] = $certificateStatus;
				}
			}else{
				$certificateImage = $single_summary_data->certificate;
			}
			///////////////////////  certificate  Check ENDS   ///////////////////////////////////////

				///////////////////////  certificate  Check STARTS   ///////////////////////////////////////
			if(isset($_FILES['hq_certificate']) && !empty($_FILES['hq_certificate']['name'])){
				$hq_certificateStatus = fileuplodCi('hq_certificate', $target_dir); 
				$extension = strtolower(pathinfo($hq_certificateStatus, PATHINFO_EXTENSION));
				if(in_array($extension,$imageExts)){
					$hq_certificateImage = $certificateStatus;
					if(!empty($single_summary_hq_data)){
						if (is_file(FCPATH.'/'.$single_summary_hq_data->certificate)) {
							unlink(FCPATH.'/'.$single_summary_hq_data->certificate);
						}
					}
					
				}else{
					$data['status']='No';
					$data['message']['certificate'] = $hq_certificateStatus;
				}
			}else{
				$hq_certificateImage = $single_summary_hq_data->certificate;
			}
			///////////////////////  certificate  Check ENDS   ///////////////////////////////////////

			
				$dateOfBirth = date_format(date_create_from_format('d-m-Y', $this->input->post('dateOfBirth')), 'Y-m-d');
				$summary_data = array('application_no'=>$applicationNo,'advertiseNo'=>$this->input->post('advertiseNo'),'discipline'=>$this->input->post('discipline'),'post'=>$this->input->post('post'),'postCode'=>$this->input->post('postCode'),'name'=>$this->input->post('name'),'dateOfBirth'=>$dateOfBirth,'nationality'=>$this->input->post('nationality'),'category'=>$this->input->post('category'),'closingDate'=>$this->input->post('closingDate'),'centralStateGovt'=>$this->input->post('centralStateGovt'),'yearsOfExperience'=>$this->input->post('yearsOfExperience'),'areasOfExperience'=>$this->input->post('areasOfExperience'),'postalAddressCommunication'=>$this->input->post('postalAddressCommunication'),'city'=>$this->input->post('city'),'pin'=>$this->input->post('pin'),'teleNo'=>$this->input->post('teleNo'),'mobile'=>$this->input->post('mobile'),'fax'=>$this->input->post('fax'),'email'=>$this->input->post('email'),'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
				$data_summary_eq_mst = array('application_no'=>$applicationNo,'examUniversityRank'=>$this->input->post('examUniversityRank'),'university'=>$this->input->post('university'),'subject'=>$this->input->post('subject'),'month'=>$this->input->post('month'),'year'=>$this->input->post('year'),'average'=>$this->input->post('average'),'grade'=>$this->input->post('grade'),'certificate'=>$certificateImage);

				$data_summary_hq_mst = array('application_no'=>$applicationNo,'examUniversityRank'=>$this->input->post('hq_examUniversityRank'),'university'=>$this->input->post('hq_university'),'subject'=>$this->input->post('hq_subject'),'month'=>$this->input->post('hq_month'),'year'=>$this->input->post('hq_year'),'average'=>$this->input->post('hq_average'),'grade'=>$this->input->post('hq_grade'),'certificate'=>$hq_certificateImage,
);
				$summary_mst_insert =  $this->Common_model->insertData('summary_mst',$summary_data);
				$summary_eq_mst_insert =  $this->Common_model->insertData('summary_eq_mst',$data_summary_eq_mst);
				$summary_hq_mst_insert =  $this->Common_model->insertData('summary_hq_mst',$data_summary_hq_mst);
				$education_data_update = $this->Common_model->update_data('application_mst',array('application_no'=>$applicationNo),array('status'=>'Y','updated_at'=>date('Y-m-d H:i:s')));
				$single_application_data = $this->Common_model->get_single('application_mst', array('application_no'=>$applicationNo));
				$url = base_url().'admin/application/details/?id='.$single_application_data->id;
				$applicationArray = array('applicationNo'=>'');
				$this->session->set_userdata($applicationArray);
				$from_email = "info@marketingplatform.ca";
				$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Email template</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
</head>

<body>
	<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center" bgcolor="#d6bf90">
    	<tr>
        	<td>
            	<table border="0" cellpadding="0" cellspacing="0" width="650px" align="center">
                	<tr>
                    	<td>
                        	<table border="0" cellpadding="0" cellspacing="0" width="600px" align="center" bgcolor="#fff;">
                            	<tr>
                                	<td bgcolor="#f2f2f2" align="center"><p style="height:6px; margin:2px 0;">&nbsp;</p><img src="'.base_url().'/public/site/images/logo.png" width="100" height="100"  alt="" /><p style="height:6px; margin:2px 0;">&nbsp;</p></td>
                                </tr>
                                
                                <tr>
                                	<td>
                                    	<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#fff">
                                        	<tr>
                                            	<td width="20px">&nbsp;</td>
                                                <td>
                                                	<h1 style="font-family:\'Open Sans\', sans-serif; font-size:16px; color:#000;"> You have a new job application from the following user. Mentioned below are the details.</h1>

                                                    <p style="font-family:\'Open Sans\', sans-serif; font-size:14px; color:#3b3b3b;">
                                                    Advertise No : '.$single_application_data->advertise_id.'
                                                    </p>
                                                    <p style="font-family:\'Open Sans\', sans-serif; font-size:14px; color:#3b3b3b;">
                                                    Application ID/Ref. no : '.$single_application_data->application_no.'
                                                    </p>
                                                    <p style="font-family:\'Open Sans\', sans-serif; font-size:14px; color:#3b3b3b;">
                                                    Email ID : '.$this->session->userdata('email').'
                                                    </p>
                                                  <p style="font-family:\'Open Sans\', sans-serif; font-size:14px; color:#3b3b3b;">
                                                   URL : '.$url.'
                                                    </p>
                                                    
                                                    
                                                    <p style="height:5px; margin:2px 0;">&nbsp;</p>
                                                    
                                                    <p style="font-family:\'Open Sans\', sans-serif; font-size:14px; color:#3b3b3b;">Best Regards,<br />
                                                    The SAMEER KOLKATA Team</p>
                                                    
                                                    
                                                    <p style="height:5px; margin:6px 0;">&nbsp;</p>
                                                </td>
                                                
                                                <td width="20px">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                            </table>
                        </td>
                    </tr>
                    
                    
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
	</table>
</body>
</html>';
$config = array();
/*$config['protocol'] = 'smtp';*/
$config['smtp_host'] = 'mail.authsmtp.com';
//$config['smtp_encryption'] = 'ssl';
$config['smtp_user'] = 'hrd@mmw.sameer.gov.in';
$config['smtp_pass'] = 'sameercal@321';
$config['smtp_port'] = 25;
$this->email->initialize($config);

$this->email->from('hrd@mmw.sameer.gov.in','SAMEER Kolkata Centre'); 
$this->email->to('hrd@mmw.sameer.gov.in');
$this->email->subject('New Apply '); 
$this->email->message($message); 

//$this->email->send();
 $mailResult = $this->send_email->mail_send_new('hrd@mmw.sameer.gov.in','New Apply',$message);
				$data['status'] = 'Yes';
				$data['application_no'] = $single_application_data->application_no;
			}else{
				$data['status']='No';
				$errorMessage = array('advertiseNo' => form_error('advertiseNo'),'discipline' => form_error('discipline'),'post' => form_error('post'),'postCode' => form_error('postCode'),'name' => form_error('name'),'dateOfBirth' => form_error('dateOfBirth'),'nationality' => form_error('nationality'),'closingDate' => form_error('closingDatecentralStateGovt'),'hq_examUniversityRank' => form_error('hq_examUniversityRank'),'hq_university' => form_error('hq_university'),'hq_subject' => form_error('hq_subject'),'hq_month' => form_error('hq_month'),'hq_year' => form_error('hq_year'),'hq_average' => form_error('hq_average'),'hq_grade' => form_error('hq_grade'),'examUniversityRank' => form_error('examUniversityRank'),'university' => form_error('university'),'subject' => form_error('subject'),'month' => form_error('month'),'year' => form_error('year'),'average' => form_error('average'),'grade' => form_error('grade'),'pin' => form_error('pin'),'mobile' => form_error('mobile'),'email' => form_error('email'),'certificate' => form_error('certificate'),'hq_certificate'=>form_error('hq_certificate'),'closingDate'=>form_error('closingDate'));
				
				$data['message'] = $errorMessage;
			}


			}else{
				$data['status']='No';
			}
			echo json_encode($data);
		}
  }