<?php
class Searcher extends User {



    static public function save($data) {
        try {
            $db = Db::connect();

            $stmt= $db->prepare('insert into user ( fname,lname,email,password,role)
                                            VALUES (:fname,:lname,:email,:password,:role)');
            $stmt->bindParam(':fname',$data['fname']);
            $stmt->bindParam(':lname',$data['lname']);
            $stmt->bindParam(':email',$data['email']);
            $stmt->bindParam(':password',$data['password']);
            $stmt->bindParam(':role',$data['role']);

                // Check if user insertion is successful
                if ($stmt->execute()) {
                    // Insert additional data into 'searcher' table
                        $userId =$db->lastInsertId(); // Get the ID of the inserted user
                        $stmtSearcher = Db::connect()->prepare('INSERT INTO searcher (id) VALUES (:id)');
                        $stmtSearcher->bindParam(':id', $userId);

                        if ($stmtSearcher->execute()) {
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