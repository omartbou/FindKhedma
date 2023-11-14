<?php

class LoginController
{
    private $errors=[];
    public function auth()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['login'])) {
                // Debugging statements
                $data['email'] = $_POST['email'];
                $result = User::login($data);
                if (!empty($_POST['password']) && !empty($_POST['email'])) {
                    if ($result) {
                       if(password_verify($_POST['password'], $result->password)){
                        $_SESSION['logged'] = true;
                        $_SESSION['id'] = $result->id;
                        $_SESSION['fname'] = $result->fname;
                        $_SESSION['lname'] = $result->lname;
                        $_SESSION['email'] = $result->email;
                        $_SESSION['role'] = $result->role;
                        Redirect::to('home');
                    } else {
                            $this->errors[]='Invalid password ';
                        }

                } else{
                        $this->errors[]="The provided email doesn't exist";
                    }

            }     else {
                    $this->errors[]="Please fill the fields";
                }
        }
    }
    }
    public function getErrors()
    {
        return $this->errors;
    }

}


?>