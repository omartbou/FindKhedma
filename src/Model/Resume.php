<?php
class Resume{
    static public function uploadResumepdf($filename,$offerId,$searcherId)
    {
        try {

            $stmt = Db::connect()->prepare('INSERT INTO resume (resume_file,searcher_id,offer_id) 
                                                  VALUES (:resume_file,:searcher_id,:offer_id)');
            $stmt->bindParam('resume_file', $filename);
            $stmt->bindParam('searcher_id', $searcherId);
            $stmt->bindParam('offer_id', $offerId);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            // Handle any database errors here
            return false;
        }
    }
}

?>