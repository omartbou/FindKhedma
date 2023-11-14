<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

class MailerService{

    public function sendEmail($subject,$email,$text){
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'b32e595eb919db';
        $phpmailer->Password = '333257b018efb8';
        $phpmailer->setFrom('no-reply@findkhdema.com', 'FindKhedma');
        $phpmailer->addAddress($email);
        $phpmailer->Subject = $subject;
        $phpmailer->Body =$text;
        if ($phpmailer->send()) {
            return true; // Email sent successfully
        } else {

            echo 'error'.$phpmailer->ErrorInfo; // Email sending failed
        }

    }
}
?>