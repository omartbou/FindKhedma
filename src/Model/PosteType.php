<?php

class PosteType{
    static public function select(){
        $stmt=Db::connect()->prepare('SELECT * FROM post_type');
        $stmt->execute();
        $results = $stmt->fetchAll(); // Fetch results
        return $results;

    }
}
?>