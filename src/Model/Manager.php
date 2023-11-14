<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
class Manager extends User
{
    static public function save($data)
    {
        try {
            $db = Db::connect();

            $stmt = $db->prepare('insert into user ( fname,lname,email,password,role)
                                            VALUES (:fname,:lname,:email,:password,"manager")');
            $stmt->bindParam(':fname', $data['fname']);
            $stmt->bindParam(':lname', $data['lname']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $data['password']);

            // Check if user insertion is successful
            if ($stmt->execute()) {
                // Insert additional data into 'searcher' table
                $userId = $db->lastInsertId(); // Get the ID of the inserted user
                $stmtManager = Db::connect()->prepare('INSERT INTO manager (id) VALUES (:id)');
                $stmtManager->bindParam(':id', $userId);

                if ($stmtManager->execute()) {
                    return 'ok'; // Return 'ok' for successful user and searcher insertion
                } else {
                    return 'error'; // Return 'error' if searcher insertion fails
                }
            } else {
                return 'error'; // Return 'error' if user insertion fails
            }


        } catch (PDOException $e) {
            return 'error';
        }
    }

}
?>