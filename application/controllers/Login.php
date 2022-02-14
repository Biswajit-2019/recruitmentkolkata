<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->library('form_validation');
		
		$this->load->database();
		$this->load->model(array('Common_model'));
		$this->load->library('user_agent');
		$this->load->library('email'); 
		if($this->session->userdata('logged_in')) {
			$newdata = array('advtNo'=> $this->input->get('advtNo'));
			$this->session->set_userdata($newdata);
			redirect('dashboard');
		} 
      }

	public function index()
	{
		$data['metaTitle']='Login';
		$data['metaKeywords']='Login';
		$data['metaDescription']='Login';
		$this->load->view('includes-recruitment/user-header',$data);
		$this->load->view('recruitment/user-login',$data);
		$this->load->view('includes-recruitment/footer');
	}
	public function otp_verification()
	{
		$email = $this->input->post('email');
		$otp = $this->input->post('otp');
		$where_clause = array('email' => $email);
		$single = $this->Common_model->get_single('job_users_mst', $where_clause);
		if($single->otp==$otp){
			$educationCount = $this->Common_model->getNumrows('application_mst',array('user_id'=>$single->id,'status'=>'N'));
			if($educationCount>0){
				$applicationSingle = $this->Common_model->get_single('application_mst', array('user_id'=>$single->id,'status'=>'N'));
				$applicationNo = ($applicationSingle)?$applicationSingle->application_no:'' ;
			}else{
				$applicationNo = '';
			}
			
			$newdata = array(
					'email'  => $single->email,
					'id'     => $single->id,
					'advtNo'=> $this->input->post('advtNo'),
					'applicationNo'=> $applicationNo,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($newdata);
			$data = array("type" => "verifi","status" => "1", "message" => "Please enter a valid otp number.");
		}else{
			$data = array("type" => "verifi","status" => "0", "message" => "Please enter a valid otp number.");
		}
		echo json_encode($data);
	}
	public function send_otp1()
	{
		$data = array("type" => "send","status" => "1", "message" => "OTP is sent to Your Email.");
		echo json_encode($data);
	}
	public function send_otp()
	{
		$to_email = $this->input->post('email');
		$where_clause = array('email' => $to_email);
		$rows = $this->Common_model->getNumrows('job_users_mst', $where_clause);
		if($rows>0){
			$otp1 = mt_rand(100000, 999999);
			$update = $this->Common_model->update_data('job_users_mst',$where_clause,array('otp'=>$otp1,'updated_at'=>date("Y-m-d H:i:s")));
			$single = $this->Common_model->get_single('job_users_mst', $where_clause);
			$otp = $single->otp;
		}else{
			$otp = mt_rand(100000, 999999);
			$insert = $this->Common_model->insertData('job_users_mst',array('email'=>$to_email,'otp'=>$otp,'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")));
		}
		$url = 'http://kolkata.sameer.gov.in';
		//$from_email = "info@marketingplatform.ca";
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
         if($mailResult){
	        	  $data = array("type" => "send","status" => "1", "message" => "OTP is sent to Your Email.");
	        } else{
	        	$data = array("type" => "send","status" => "1", "message" => "OTP is sent to Your Email.");
	        }
		echo json_encode($data);
	}

	
	
	

}
