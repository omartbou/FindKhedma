<?php

class UserController {
    public function profile() {
        $userID = $_SESSION['id'];
        return User::selectInfo($userID);
    }

    public function updateInfo() {
        $userID = $_SESSION['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            if (!empty($_POST['fname']) && !empty($_POST['lname'])) {
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                if (User::updateInfoById($userID, $fname, $lname)) {
                    header('refresh:0');
                    header('refresh:0');
                    Session::set('success','You have updated your info (s) with success');
                } else {
                }
            }
        }
    }

    public function updatePassword() {
        $userID = $_SESSION['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirmPassword'];
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                if(isset($password)===isset($confirmPassword)){
                if (User::updatePasswordById($userID, $passwordHash)) {
                    header('refresh:0');
                    Session::set('success','Your password has been updated with success');
                }
                } else {
                    // Handle the case where the update failed
                }
            }
        }
    }
    public function displayUsers(){
       return User::select();
    }
    public function updateUser(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
           $userId= $_GET['userId'];
            if(isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['email'])){
                if(User::updateInfoById($userId)){
                    Redirect::to('users-management');
                }
            }
        }
    }
    public function getUserById(){
            if(isset($_GET['userId'])){
                $userId=$_GET['userId'];
                return User::selectInfo($userId);
            }

        }
        public function deleteUser(){
        if(isset($_GET['userId'])){
            $userId=$_GET['userId'];
            User::delete($userId);
        }
        }

}
?>


