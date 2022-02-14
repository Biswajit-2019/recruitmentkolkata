<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Send_email {

  public function mail_send_new($to,$subject,$message){
    require 'phpmailder/vendor/autoload.php';

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'mmw.sameer.gov.in';                    
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'donotreply@mmw.sameer.gov.in';                    
    $mail->Password   = 'pratiuttar#rec2021';                              
    //$mail->Port       = 587; 
    $mail->setFrom('donotreply@mmw.sameer.gov.in', 'SAMEER Kolkata Centre');
    $mail->addAddress($to); 

    $mail->isHTML(true);                                  
    $mail->Subject = $subject;
    $mail->Body    = $message;
    if($mail->send()){
      return 1;
    }else{
      return 0;
    }

  }  

}
