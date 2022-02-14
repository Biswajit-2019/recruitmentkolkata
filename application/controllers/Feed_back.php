<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Feed_back extends CI_Controller {
	public function __construct() 
    {
		 parent:: __construct();		 
		 $this->load->model('Common_model');
		 $this->load->library('form_validation');
		 $this->load->library('email');
		 $this->email->set_mailtype("html");
		 // $this->load->model('Join_model');
	}

	public function index(){
		
		
		if($this->input->post('feedback'))
		{
			
	    $this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('feed', 'Feedback', 'required');
		$this->form_validation->set_rules('txtemail', 'Email', 'required');
		$this->form_validation->set_rules('answer', 'answer', 'callback_captcha_check');

		if ($this->form_validation->run() == FALSE)
		{
			    $param=array('parent_id'=>0,'header'=>'Y');
				$data['cms']= $this->Common_model->dbQuery1("SELECT * FROM `cms_pages` WHERE `parent_id`=0 AND `header`='Y' ORDER BY menu_order ASC");
				$data['metaTitle']='Feed Back';
				$data['metaKeywords']='Feed Back';
				$data['metaDescription']='Feed Back';
				$this->load->view('includes/header',$data);
				$this->load->view('feedback');
				$this->load->view('includes/footer');
		}
		else
		{
			

			    $url=base_url();
				$email=$this->input->post('txtemail');
				$name=$this->input->post('name');
				$feed=$this->input->post('feed');
				
				$this->email->from($email, $name);
				$this->email->to('avijit.micronixsystem@gmail.com'); 			
				$this->email->subject('Feedback');
				$msg='<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Newsletter Title</title>
<link href="http://fonts.googleapis.com/css?family=Roboto:400,300,700" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" bgcolor="#ffe77b" style="background-color:#f5f5f5;"><br>
    <br>
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="70" align="center" valign="middle"><img src="'.$url.'/public/site/images/logo.png" width="292" height="54" style="display:block;"></td>
      </tr>
      
      <tr>
        <td align="left" valign="top" bgcolor="#564319" style="background-color:#1074a8; font-family:Roboto, sans-serif; padding:10px;"><div style="color: #ffffff;font-size: 30px;    line-height: 34px;text-align: center;"><b>User Feedback</b></div>
          </td>
      </tr>
      <tr>
        <td align="left" valign="top" bgcolor="#ffffff" style="background-color:#ffffff;">
         
         
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-bottom:15px;">
            <tr>
            	<td>&nbsp;</td>
              <td align="left" valign="middle" style="padding:15px; font-family:Roboto, sans-serif;">
              <div style="font-size:13px; color:#222; text-align:justify;margin: 30px 0;">
              Name :'.$name.'<br><br>
              Email:'.$email.'<br><br>
              Feedback :'.$feed.'
              </div>

Thanks<br>
Support – Sameer Kolkata<br>
<p style="margin:20px 0 0;"><a href='.$url.'>sameerkolkata.com</a></p>
<span style="font-size:13px; color:#222; text-align:justify;">Email: support@sameerkolkata.com</span><br>
<span style="font-size:13px; color:#222; text-align:justify;">Copyright '.date('Y').'</span>
             
              </td>
              <td>&nbsp;</td>
            </tr>
          </table>
         
          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="50%" align="left" valign="middle" style="padding:10px;"><table width="75%" border="0" cellspacing="0" cellpadding="4">
                
               
              </table></td>
              <td width="50%" align="left" valign="middle" style="color:#564319; font-size:11px; font-family:"Roboto", sans-serif; padding:10px;">&nbsp;</td>
            </tr>
          </table></td>
      </tr>
     
      </table>
    <br>
    <br></td>
  </tr>
</table>
</body>
</html>';
				$this->email->message($msg);	
				$this->email->send();
				
				 $this->session->set_flashdata('newsSucc', 'Form submitted successfully we will get back to you soon.');
				redirect('feed-back');

				/*$data['success']='Form submitted successfully we will get back to you soon.';
				$param=array('parent_id'=>0,'header'=>'Y');
				$data['cms']=$this->Common_model->getData('cms_pages',$param);
				$data['metaTitle']='Feed Back';
				$data['metaKeywords']='Feed Back';
				$data['metaDescription']='Feed Back';
				$this->load->view('includes/header',$data);
				$this->load->view('feedback',$data);
				$this->load->view('includes/footer');*/
		}

				

			}
			else
			{
				$param=array('parent_id'=>0,'header'=>'Y');
				$data['cms']=$this->Common_model->dbQuery1("SELECT * FROM `cms_pages` WHERE `parent_id`=0 AND `header`='Y' ORDER BY menu_order ASC");
				$data['metaTitle']='Feed Back';
				$data['metaKeywords']='Feed Back';
				$data['metaDescription']='Feed Back';
				$this->load->view('includes/header',$data);
				$this->load->view('feedback');
				$this->load->view('includes/footer');
			}	

	}
	function captcha_check($answer)
	{
		if ($answer=='')
		{
			$this->form_validation->set_message('captcha_check', 'The %s field can not be empty');
			return FALSE;
		}
		elseif($answer!=$this->session->userdata('number1')+$this->session->userdata('number2'))
		{
			$this->form_validation->set_message('captcha_check', 'The %s does not match');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

}

?>
