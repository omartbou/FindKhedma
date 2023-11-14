<?php
class Messages{
    static public function send($sender_id,$receiver_id,$message){
        try {
            $stmt = Db::connect()->prepare('INSERT INTO messages (sender_id, receiver_id, message, created_at)
                                                  VALUES (:sender_id, :receiver_id, :message, NOW())');
            $stmt->execute(array(
                ':sender_id' => $sender_id,
                ':receiver_id' => $receiver_id,
                ':message' => $message
            ));
            return ['message' => 'Message sent successfully'];

        }catch(PDOException $e){
            echo 'error'.$e->getMessage();
        }

    }
    static public function getManagerMessages( $manager_id){
        try {
            $stmt = Db::connect()->prepare('SELECT u.id, u.fname, u.lname,u.email
            FROM user AS u
            INNER JOIN resume AS r ON u.id = r.searcher_id
            INNER JOIN offer AS o ON r.offer_id = o.id
            WHERE o.manager_id = :manager_id');

            $stmt->execute([ 'manager_id' => $manager_id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Log the error message instead of echoing
            error_log('Error: ' . $e->getMessage());
            // You can also throw an exception or return an error message here
            return false;
        }
    }

    static public function getSearcherMessages($receiver_id){
        try{
            $stmt=Db::connect()->prepare('SELECT DISTINCT  m.*,u.id,u.fname,u.lname,o.manager_id,o.company_name
                                                From messages AS m 
                                                INNER JOIN user AS u ON m.sender_id=u.id
                                                INNER JOIN offer AS o ON o.manager_id=u.id
                                                WHERE m.receiver_id=:receiver_id');
            $stmt->execute(['receiver_id'=>$receiver_id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Check the number of rows affected
            return $result;
        }catch (PDOException $e){
            echo 'error'.$e.getMessage();
        }
    }
    static public function select($sender_id,$receiver_id) {
        try {
            $stmt = Db::connect()->prepare('SELECT m.*,u.email,u.fname,u.lname,o.manager_id,o.company_name
                                                  FROM messages AS m
                                                  INNER JOIN user AS u ON m.sender_id=u.id 
                                                  INNER JOIN offer AS o ON o.manager_id=u.id 
                                                  WHERE (sender_id = :sender_id AND receiver_id = :receiver_id)
                                                  OR (sender_id = :receiver_id AND receiver_id = :sender_id) 
                                                  ORDER BY created_at ASC');

            $stmt->execute([':sender_id' => $sender_id,':receiver_id'=>$receiver_id]);
            $result = $stmt->fetchAll(); // Check the number of rows affected
            return $result;

        } catch (PDOException $e) {
            echo 'error' . $e->getMessage();
        }
    }

}