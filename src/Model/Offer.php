<?php
class Offer
{
    static public function getAllOffers()
    {
        try {
            $stmt = Db::connect()->prepare('SELECT offer.*,post_type.type_name AS tname
            FROM offer
            JOIN post_type ON offer.post_type_id = post_type.id
        ');
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->close();
            $stmt=null;
        } catch (PDOException $e) {
            // Handle any database errors here
            // You can log the error or throw a custom exception if needed
            echo "Database Error: " . $e->getMessage();
            return false; // Return false or handle the error as per your application's needs
        }

}static public function getOfferById($offerId)
    {
        try {
            $stmt = Db::connect()->prepare('SELECT offer.*, post_type.type_name AS tname
            FROM offer
            JOIN post_type ON offer.post_type_id = post_type.id
            WHERE offer.id = ?
            ');
            $stmt->execute([$offerId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle any database errors here
            // You can log the error or throw a custom exception if needed
            echo "Database Error: " . $e->getMessage();
            return false; // Return false or handle the error as per your application's needs
        }
    }

        static public function SearchOffers($data){
        try {
            $search = $data['search_offers'];
            $searchCity = $data['search_cities'];
            $stmt = Db::connect()->prepare('SELECT offer.*,post_type.type_name
            FROM offer     
            JOIN post_type ON offer.post_type_id = post_type.id
            WHERE city LIKE ? AND   (company_name LIKE ? OR title LIKE ? OR type_name LIKE ?) 
             ');
            $stmt->execute(array('%'.$searchCity.'%','%'.$search.'%','%'.$search.'%','%'.$search.'%'));
            return $stmt->fetchALL();
            }catch(PDOException $e){
            // Handle any database errors here
            // You can log the error or throw a custom exception if needed
            echo "Database Error: " . $e->getMessage();
            return false; // Return false or handle the error as per your application's needs
        }
}
    static public function save($data){
        try{

            $post_type_id = $data['post_type_id']; // Extract the post_type_id from the data array
            $description = $data['description'];
            $salary = $data['salary'];
            $title = $data['title'];
            $city = $data['city'];
            $company = $data['company_name'];

            $stmt=Db::connect()->prepare('INSERT INTO offer (post_type_id,description,salary,title,created_at,updated_at,city,company_name) VALUES  (:post_type_id,:content,:salary,:title,NOW(),NOW(),:city,:company_name)');
            $stmt->bindParam(':post_type_id',$post_type_id);
            $stmt->bindParam(':content',$description);
            $stmt->bindParam(':salary',$salary);
            $stmt->bindParam(':title',$title);
            $stmt->bindParam(':city',$city);
            $stmt->bindParam(':company',$company);
            if ($stmt->execute()) {
                return 'ok'; // Return 'ok' for successful user and searcher insertion
            } else {
                return 'error'; // Return 'error' if searcher insertion fails
            }
        }catch (PDOException $e) {
            return 'error: ' . $e->getMessage();
        }

    }
static public function getOffersById ($managerId){
        try{
            $stmt=Db::connect()->prepare('SELECT r.*,u.fname,u.lname,u.email,o.*,p.* FROM resume AS r
                                                INNER JOIN offer AS o ON r.offer_id=o.id
                                                INNER JOIN post_type AS p ON o.post_type_id=p.id
                                                INNER JOIN searcher AS s ON r.searcher_id=s.id
                                                INNER JOIN user AS u ON s.id = u.id

                                                WHERE o.manager_id= :manager_id');
            $stmt->bindParam(':manager_id', $managerId);
            $stmt->execute();
            $result= $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }catch(PDOException $e){
            echo 'error'.$e.getMessage();
        }

}
   static public function delete($offerID)
   {
       try {
           $stmt = Db::connect()->prepare('DELETE FROM offer WHERE id =:id');
           $stmt->bindParam(':id', $offerID, PDO::PARAM_INT);
           $stmt->execute();
           if ($stmt->execute()) {
               return 'ok';
           } else {
               return 'error';
           }
       }catch(PDOException $e){
           echo 'error'.$e.getMessage();
       }
   }
   static public function selectRequestsById($userId){
        $stmt=Db::connect()->prepare('SELECT r.*,o.id,o.post_type_id,o.title,o.company_name,p.* 
                                            FROM resume AS r
                                            INNER JOIN offer AS o ON r.offer_id = o.id
                                            INNER JOIN post_type AS p ON o.post_type_id = p.id
                                            WHERE searcher_id =:id');
        $stmt->execute(['id'=>$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

   }

}

?>