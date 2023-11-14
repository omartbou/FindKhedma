<?php
class OffersController{

    public function OffersList(){
        $offers = Offer::getAllOffers();

            return $offers;
    }
    public function offerDetail($offerId){
        $offerDetail = Offer::getOfferById($offerId);
        return $offerDetail;

        }

   public function findOffers($data)
   {
       $searchOffers = isset($data['search_offers']) ? $data['search_offers'] : '';
       $searchCities = isset($data['search_cities']) ? $data['search_cities'] : '';
       $offers = array(); // Initialize an empty array to store the offers

       if (!empty($searchCities)&&!empty($searchOffers)) {
           $data = array(
               'search_offers' => $searchOffers,
               'search_cities' => $searchCities
           );

       }
       $offers = Offer::SearchOffers($data);


       return $offers;
   }

public function content()
    {

        if (isset($_POST['submit'])) {
            $data =array(
                'post_type_id'=>$_POST['post_type'],
                'description'=>$_POST['editor_content'],
                'salary'=>$_POST['salary'],
                'title'=>$_POST['title'],
                'city'=>$_POST['city'],
                'company'=>$_POST['company']
            );
            $result = Offer::save($data);
            if ($result) {
                header('refresh:0');
                Session::set('success','Your post has been published with success');
            }
        }

    }
    public function getPostType(){
       return PosteType::select();
    }


    public function uploadResumes()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $offerId = $_GET['offer_id'];
            $searcherId = $_SESSION['id'];

            $uploadDir = "../uploads/"; // Specify the directory to store uploaded files
            $pdfFileType = "application/pdf";
            if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
                if ($_FILES['resume']['type'] === $pdfFileType) {
                    $filename = uniqid().time(). ".pdf";
                    $destination = $uploadDir . $filename;
                    if (move_uploaded_file($_FILES['resume']['tmp_name'], $destination)) {
                        Resume::uploadResumepdf($filename,$offerId,$searcherId);

                    }
                } else {
                    echo "Only PDF files ";
                }
                Redirect::to('offerdetail?offer_id='.$offerId);
                Session::set('success', 'You uploaded your resume with success');

            }
        }
    }
    public function selectRequests(){
        $managerId=$_SESSION['id'];
        return Offer::getOffersById($managerId);
    }
    public function deleteOffer($delete){
         Offer::delete($delete);
        }
        public function myRequest(){
        if (isset($_SESSION['id'])) {
            $userId=$_SESSION['id'];
            return Offer::selectRequestsById($userId);
        }
        }

}

?>