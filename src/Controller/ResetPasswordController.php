<?php
class ResetPasswordController
{
    public function resetRequestPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['email'])) {
            $email = $_POST['email'];
            if (User::selectEmail($email)) {
                $bytes = openssl_random_pseudo_bytes(16);
                $resetToken = bin2hex($bytes);
                $resetLink = "http://localhost:8080/untitled/src/reset-password?token=$resetToken";

                User::resetRequest($email, $resetToken);
                $mail = new MailerService();
                $subject='Reset Password';
                $text='Hello this is  your password reset link '.$resetLink;
                $send =$mail->sendEmail($subject,$email,$text);
                if($send){
                    $message='An Email has been sent to you check your inbox please';
                    Redirect::to('login');
                    Session::set('success',$message);

                }
                else{
                    Redirect::to('login');
                    Session::set('error','Failed to send the email');
                }


            }
            else{

               header('refresh:0');
               Session::set('error',"This email doesn't exist");
            }

        }
    }
    public function resetPassword($postData){
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            if (isset($postData['token']) && isset($postData['password']) && isset($postData['confirm_password'])) {
            $token = $_POST['token'];
            $new_password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            if(!empty($new_password)&&!empty($confirm_password)){

                if ($new_password === $confirm_password){

                    $new_password=password_hash($new_password, PASSWORD_BCRYPT);
                    User::updatePassword($new_password,$token);
                    Redirect::to('login');
                    Session::set('success','password has been updated successfully');

                }
            }

        }
    }
}
}
?>