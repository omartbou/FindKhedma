<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
abstract class User   {



abstract static function save($data);
//login
    static public function login($data) {
        $email = $data['email'];
        try {
            $stmt = Db::connect()->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->execute(array(':email'=> $email));
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            return $user;
            if($stm->execute()){
                return 'ok';
            }



        }catch(PDOException $e){
            echo 'error'.$e->getMessage();
        }

    }

    //Display User's Infos
    static public function selectInfo($userID){
        try {
            $stmt = Db::connect()->prepare('SELECT * FROM user WHERE id=:id ');
            $stmt->execute([':id' => $userID]);
            return $stmt->fetch();
        }catch(PDOException $e){
            echo 'error'.$e.getMessage();
        }


    }
    //Update User's Profile
    static public function updateInfoById($userID,$fname,$lname){
        try {
            $stmt = Db::connect()->prepare('UPDATE  user
                                            SET fname=:fname ,lname=:lname 
                                            WHERE id=:id ');
            $stmt->execute([':fname' => $fname, ':lname' => $lname, ':id' => $userID,]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            echo 'error'.$e.getMessage();
        }

    }
    //Update Password
    static public function updatePasswordById($userID,$password){
        try {
            $stmt = Db::connect()->prepare('UPDATE  user
                                            SET password=:password 
                                            WHERE id=:id ');
            $stmt->execute([':password' => $password, ':id' => $userID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            echo 'error'.$e.getMessage();
        }


    }

   //display all users
    static public function select(){
        try {
            $stmt = Db::connect()->prepare('SELECT * FROM user ');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            echo 'error'.$e.getMessage();
        }

    }

    public function delete($userId){
        $stmt=Db::connect()->prepare('DELETE FROM user where id=:id');
        $stmt->execute(':id',$userId);

    }
    //Reset Password
    static public function selectEmail($email){
        try {
            $stmt = Db::connect()->prepare('SELECT id,email FROM user WHERE email= :email');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }
        catch(PDOException $e){
            echo 'error'.$e.getMessage();
        }

    }
    static public function resetRequest($email,$resetToken){
        try {
            $stmt = Db::connect()->prepare('INSERT INTO reset_password (user_id,reset_token,expires_at)
                                            VALUES (:user_id,:reset_token,:expires_at) ');
            $user_id = self::selectEmail($email)['id'];
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour')); // Set expiration to 1 hour from the current time
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':reset_token', $resetToken, PDO::PARAM_STR);
            $stmt->bindParam(':expires_at', $expires_at);
            $stmt->execute();
        }
        catch(PDOException $e){
            echo 'error'.$e.getMessage();
        }

    }
   static public function updatePassword($password,$token){
        try {
            $stmt = Db::connect()->prepare('UPDATE user
                                            SET password=:password 
                                            WHERE id=( 
                                            SELECT user_id 
                                            FROM reset_password 
                                            WHERE reset_token =:token 
                                            AND expires_at > NOW()) ');
            $stmt->execute(['password' => $password, 'token' => $token]);
        }
        catch(PDOException $e){
            echo 'error'.$e.getMessage();
        }

   }
}
?>