<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Training extends CI_Controller {
	public function __construct() 
    {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('file_upload');

		$this->load->database();
		$this->load->model(array('Common_model'));
		$this->load->library('user_agent');
		$this->load->library('email'); 
	}

					
	public function index()
	{
		$param=array('parent_id'=>0,'header'=>'Y');
		$data['cms'] = $this->Common_model->dbQuery1("SELECT * FROM `cms_pages` WHERE `parent_id`=0 AND `header`='Y' ORDER BY menu_order ASC");
		$data['recruitment']=$this->Common_model->get_data('training_mst',array('status'=>'Y'),'id');
		$data['metaTitle']='Training';
		$data['metaKeywords']='Training';
		$data['metaDescription']='Training';
		$this->load->view('training-includes/header',$data);
		$this->load->view('training/training-list',$data);
		$this->load->view('training-includes/footer');
	}
	public function login()
	{
		$data['metaTitle']='Login';
		$data['metaKeywords']='Login';
		$data['metaDescription']='Login';
		$this->load->view('training-includes/user-header',$data);
		$this->load->view('training/user-login',$data);
		$this->load->view('training-includes/footer');
	}
	public function otp_verification()
	{
		$email = $this->input->post('email');
		$otp = $this->input->post('otp');
		$where_clause = array('email' => $email);
		$single = $this->Common_model->get_single('training_users_mst', $where_clause);
		if($single->otp==$otp){
			$newdata = array(
				'training_email'  => $single->email,
				'training_id'     => $single->id,
				'training_logged_in' => TRUE
			);
			$this->session->set_userdata($newdata);
			$data = array("type" => "verifi","status" => "1", "message" => "Login successful.");
		}else{
			$data = array("type" => "verifi","status" => "0", "message" => "Please enter a valid otp number.");
		}
		echo json_encode($data);
	}
	public function dashboard()
	{
		if($this->session->userdata('training_logged_in')) {
			$data['applicationStatus'] =0;
			$data['metaTitle']='Dashboard';
			$data['metaKeywords']='Dashboard';
			$data['metaDescription']='Dashboard';
			$this->load->view('training-includes/user-dash-header',$data);
			$this->load->view('training/dash-view',$data);
			$this->load->view('training-includes/footer');
		}else{
			redirect('training');
		}
	}
	public function application_form()
	{
		if($this->session->userdata('training_logged_in')) {
			$data['apply_list'] = $this->Common_model->getData('apply_mst',array());
			$data['metaTitle']='Application Form';
			$data['metaKeywords']='Application Form';
			$data['metaDescription']='Application Form';
			$this->load->view('training-includes/user-dash-header',$data);
			$this->load->view('training/application-form',$data);
			$this->load->view('training-includes/footer');
		}else{
			redirect('training');
		}
	}
	public function update_training_form()
	{
		if($this->session->userdata('training_logged_in')) {
			$data = array();
			$errorMessage = array();
			$this->form_validation->set_error_delimiters('', '');
			(isset($_POST['candidateName']))?$this->form_validation->set_rules('candidateName', 'Name', 'trim|required'):'';
			(isset($_POST['institutionName']))?$this->form_validation->set_rules('institutionName', 'Institution Name', 'trim|required'):'';
			(isset($_POST['qualification']))?$this->form_validation->set_rules('qualification', 'Qualification', 'trim|required'):'';
			(isset($_POST['contact']))?$this->form_validation->set_rules('contact', 'Contact', 'trim|required'):'';
			(isset($_POST['email']))?$this->form_validation->set_rules('email', 'Email', 'trim|required'):'';
			(isset($_POST['applying']))?$this->form_validation->set_rules('applying', 'Applying', 'trim|required'):'';
			(isset($_POST['permanentAddress']))?$this->form_validation->set_rules('permanentAddress', 'Permanent Address', 'trim|required'):'';
			(isset($_POST['messages']))?$this->form_validation->set_rules('messages', 'Messages', 'trim|required'):'';
			
			/*(isset($_FILES['uploadResume']) && !empty($_FILES['uploadResume']['name']))?'':$this->form_validation->set_rules('uploadResume', 'Upload Resume', 'trim|required');
		
			(isset($_FILES['document2']) && !empty($_FILES['document2']['name']))?'':$this->form_validation->set_rules('document2', 'Document 2', 'trim|required');		

			((isset($_FILES['document1']) && empty($_FILES['document1']['name'])) && (isset($_FILES['document3']) && empty($_FILES['document3']['name']))) ? $this->form_validation->set_rules('document1', 'Document 1', 'trim|required') : '';*/

			//(isset($_FILES['document3']) && !empty($_FILES['document3']['name']))?'':$this->form_validation->set_rules('document3', 'Document 3', 'trim|required');

			if ($this->form_validation->run() == TRUE) {

				$applying_id = $_REQUEST['applying'];
				$user_id = $this->session->userdata('training_id');	
				$count = $this->Common_model->getNumrows('training_apply_mst ',array('user_id'=>$user_id,'applying'=>$applying_id));
				

							$uploadResume ='';
							$markSheet = '';
							$certificate = '';
							$document1 = '';
							$document2 = '';
							$data['status']='Yes';
							$applicationNo = rand();
							$target_dir = "public/uploaded/training/".$applicationNo;
							if (!file_exists($target_dir)) {
								mkdir($target_dir, 0777, true);
							}
							$imageExts = array("png", "jpg", "jpeg","pdf");
							if(isset($_FILES['uploadResume']) && !empty($_FILES['uploadResume']['name'])){
								$uploadResumeStatus = fileuplodCi('uploadResume',$target_dir);
								$extension = strtolower(pathinfo($uploadResumeStatus, PATHINFO_EXTENSION));
								if(in_array($extension,$imageExts)){
									$uploadResume = $uploadResumeStatus;
								}else{
									$data['status'] ='No';
									$data['message']['uploadResume'] = $uploadResumeStatus;
								}
							}
							if(isset($_FILES['markSheet']) && !empty($_FILES['markSheet']['name'])){
								$markSheetStatus = fileuplodCi('markSheet',$target_dir);
								$extension = strtolower(pathinfo($markSheetStatus, PATHINFO_EXTENSION));
								if(in_array($extension,$imageExts)){
									$markSheet = $markSheetStatus;
								}else{
									$data['status'] ='No';
									$data['message']['markSheet'] = $markSheetStatus;
								}
							}
							if(isset($_FILES['certificate']) && !empty($_FILES['certificate']['name'])){
								$certificateStatus = fileuplodCi('certificate',$target_dir);
								$extension = strtolower(pathinfo($certificateStatus, PATHINFO_EXTENSION));
								if(in_array($extension,$imageExts)){
									$certificate = $certificateStatus;
								}else{
									$data['status'] ='No';
									$data['message']['certificate'] = $certificateStatus;
								}
							}
							if(isset($_FILES['document1']) && !empty($_FILES['document1']['name'])){
								$document1Status = fileuplodCi('document1',$target_dir);
								$extension = strtolower(pathinfo($document1Status, PATHINFO_EXTENSION));
								if(in_array($extension,$imageExts)){
									$document1 = $document1Status;
								}else{
									$data['status'] ='No';
									$data['message']['document1'] = $document1Status;
								}
							}
							if(isset($_FILES['document2']) && !empty($_FILES['document2']['name'])){
								$document2Status = fileuplodCi('document2',$target_dir);
								$extension = strtolower(pathinfo($document2Status, PATHINFO_EXTENSION));
								if(in_array($extension,$imageExts)){
									$document2 = $document2Status;
								}else{
									$data['status'] ='No';
									$data['message']['document2'] = $document2Status;
								}
							}
							
							
							
							if($data['status']=='Yes'){					
								$application_mst_data = array('user_id'=>$this->session->userdata('training_id'),'application_no'=>$applicationNo,'application_status'=>'0','status'=>'Y','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));

								$insert =  $this->Common_model->insertData('training_application_mst',$application_mst_data);				
								$apply_data = array('user_id'=>$this->session->userdata('training_id'),'application_no'=>$applicationNo,'candidateName'=>$this->input->post('candidateName'),'institutionName'=>$this->input->post('institutionName'),'qualification'=>$this->input->post('qualification'),'contact'=>$this->input->post('contact'),'email'=>$this->input->post('email'),'applying'=>$this->input->post('applying'),'permanentAddress'=>$this->input->post('permanentAddress'),'messages'=>$this->input->post('messages'),'uploadResume'=>$uploadResume,'markSheet'=>$markSheet,'certificate'=>$certificate,'document1'=>$document1,'document2'=>$document2,'createDate'=>date('Y-m-d H:i:s'),'updateDate'=>date('Y-m-d H:i:s'));
								$apply_data_insert = $this->Common_model->insertData('training_apply_mst',$apply_data);

								$url = base_url().'admin/training/details/?id='.$apply_data_insert;
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
								                                                    Application ID/Ref. no : '.$applicationNo.'
								                                                    </p>
								                                                    <p style="font-family:\'Open Sans\', sans-serif; font-size:14px; color:#3b3b3b;">
								                                                    Email ID : '.$this->session->userdata('training_email').'
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
								$config['mailtype'] = 'html';
								$config['smtp_host'] = 'mmw.sameer.gov.in';
								$config['smtp_encryption'] = 'ssl';
								$config['smtp_user'] = 'hrd@mmw.sameer.gov.in';
								$config['smtp_pass'] = 'sameercal@321';
								$config['smtp_port'] = 465;
								$this->email->initialize($config);
								$this->email->from('hrd@mmw.sameer.gov.in','SAMEER Kolkata Centre'); 
								$this->email->to('hrd@mmw.sameer.gov.in');
								$this->email->subject('New Training Apply '); 
								$this->email->message($message); 
								//$this->email->send();
								$mailResult = $this->send_email->mail_send_new('hrd@mmw.sameer.gov.in','New Training Apply',$message);
						
				}
			}else{
				$data['status']='No';
				$errorMessage = array('candidateName' => form_error('candidateName'),'institutionName' => form_error('institutionName'),'qualification' => form_error('qualification'),'contact' => form_error('contact'),'email' => form_error('email'),'applying' => form_error('applying'),'applying' => form_error('applying'),'permanentAddress' => form_error('permanentAddress'),'messages' => form_error('messages'),'uploadResume'=>form_error('uploadResume'),'document1'=>form_error('document1'),'document2'=>form_error('document2'),'document3'=>form_error('document3'));
				$data['message'] = $errorMessage;
			}
			echo json_encode($data);
		}else{
			redirect('training');
		}
	}
	public function thank_you()
	{
		if($this->session->userdata('training_logged_in')) {
			$data['personal_data'] = '';
			$data['metaTitle']='Thank You';
			$data['metaKeywords']='Thank You';
			$data['metaDescription']='Thank You';
			$this->load->view('training-includes/user-dash-header',$data);
			$this->load->view('training/thank-you',$data);
			$this->load->view('training-includes/footer');
		}else{
			redirect('training');
		}
	}
	public function application_status()
	{
		if($this->session->userdata('training_logged_in')) {
			if($this->session->userdata('training_id')){
				$userId = $this->session->userdata('training_id');
				$data['application'] = $this->Common_model->get_data('training_application_mst',array('user_id'=>$userId,'status'=>'Y'),'id');
			}else{
				$data['application'] = '';
			}
			$data['metaTitle']='Application-status';
			$data['metaKeywords']='Application-status';
			$data['metaDescription']='Application-status';
			$this->load->view('training-includes/user-dash-header',$data);
			$this->load->view('training/application-status',$data);
			$this->load->view('training-includes/footer');
		}else{
			redirect('training');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('training_logged_in');
		redirect('training');
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
		if($fileName=='uploadResume'){
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='document1') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='document2') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='document3') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='markSheet') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';
		}elseif ($fileName=='certificate') {
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1024';				
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
	public function check_applying()
	{
		$applying_id = $_REQUEST['applying'];
		$user_id = $this->session->userdata('training_id');	
		$data = $this->Common_model->getAll('training_apply_mst',array('user_id'=>$user_id,'applying'=>$applying_id),'','','','');
		//print_r($data);
		$count =  count($data);
		if($count > 0){
			$valid = false;
			
		}
		else{
			$valid = true;
		}
		echo json_encode($valid);
		exit();
	}
	public function send_otp()
	{
		$to_email = $this->input->post('email');
		$where_clause = array('email' => $to_email);
		$rows = $this->Common_model->getNumrows('training_users_mst', $where_clause);
		if($rows>0){
			$otp1 = mt_rand(100000, 999999);
			$update = $this->Common_model->update_data('training_users_mst',$where_clause,array('otp'=>$otp1,'updated_at'=>date("Y-m-d H:i:s")));
			$single = $this->Common_model->get_single('training_users_mst', $where_clause);
			$otp = $single->otp;
		}else{
			$otp = mt_rand(100000, 999999);
			$insert = $this->Common_model->insertData('training_users_mst',array('email'=>$to_email,'otp'=>$otp,'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")));
		}
		$url = 'http://kolkata.sameer.gov.in';
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
			                                                <h1 style="font-family:\'Open Sans\', sans-serif; font-size:16px; color:#000;">This is a system generated automated email message. Please do not reply </h1>

			                                                	<h1 style="font-family:\'Open Sans\', sans-serif; font-size:16px; color:#000;">Welcome '.$to_email.',</h1>
			                                                    <p style="font-family:\'Open Sans\', sans-serif; font-size:14px; color:#3b3b3b;">
			                                                    Your OTP : '.$otp.'
			                                                    </p>
			                                                    <p style="font-family:\'Open Sans\', sans-serif; font-size:14px; color:#3b3b3b;">Thank you for contacting SAMEER Kolkata Centre. This email address is not monitored. Please visit us at <a href ="http://kolkata.sameer.gov.in">kolkata.sameer.gov.in</a> if you require assistance.</p>
			                                                  
			                                                    
			                                                    
			                                                    <p style="height:5px; margin:2px 0;">&nbsp;</p>
			                                                    
			                                                    <p style="font-family:\'Open Sans\', sans-serif; font-size:14px; color:#3b3b3b;">Thank you for choosing SAMEER Kolkata Centre </p>
			                                                    
			                                                    
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

			$config['mailtype'] = 'html';
			$this->email->initialize($config);
	        $this->email->from('hrd@mmw.sameer.gov.in','SAMEER Kolkata Centre'); 
	        $this->email->to($to_email);
	        $this->email->subject('Otp Send'); 
	        $this->email->message($message); 

	   		$mailResult = $this->send_email->mail_send_new($to_email,'Otp Send',$message);
	         //Send mail 
	        if($mailResult){
	        	 $data = array("type" => "send","status" => "1", "message" => "OTP is sent to Your Email.");
	        } else{
	        	 $data = array("type" => "send","status" => "1", "message" => "OTP is sent to Your Email.");
	        }
	       
			echo json_encode($data);
	}
	
}

?>
