<?php class
MessagesController{

    public function sendMessage() {

        if (isset($_SESSION['id']) && isset($_POST['userId']) && isset($_POST['message'])) {
            $sender_id = $_SESSION['id'];
            $userId = $_POST['userId'];
            $message = $_POST['message'];
            $mail=new MailerService();
            $subject='You received new message';
            $text='hello you received new message go check it in our website';
            $m= Messages::send($sender_id, $userId, $message);
            header('refresh:0');
            Session::set('success','Your message has been sent with success');
            if($m){
               $receiver= User::selectInfo($userId);

               if($receiver) {

                   $email = $receiver['email'];
                   $mail->sendEmail($subject,$email,$text);
               }
            }

        }
    }


    public function receiveMessages()
    {

        if (isset($_GET['q']) && isset($_SESSION['id'])) {
            $sender_id = intval($_GET['q']);
            $receiver_id = $_SESSION['id']; // Get the receiver's ID from the session

             $messages=Messages::select($sender_id, $receiver_id);

            return $messages;

        }

        return array();
    }

    public function selectUsers(){
            if($_SESSION['role']==='manager'){
                $manager=$_SESSION['id'];

                return Messages::getManagerMessages($manager);
            }

               else {
                   $searcher = $_SESSION['id'];
                   return Messages::getSearcherMessages($searcher);
               }

        }

    }
    ?>



