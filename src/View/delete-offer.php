<?php
if(isset($_SEESION['logged'])&&$_SEESION['logged']===true) {

if (isset($_SESSION['role']) && $_SESSION['role'] === 'manager') {

$data = new OffersController();
    if (isset($_GET['offer_id'])) {
        $offerId = $_GET['offer_id'];
        $deleteOffer = $data->deleteOffer($offerId);
        Redirect::to('my-offers');
        exit();
    } else {
        echo "Invalid request. Please specify an offer to delete.";
    }
}
}else{Redirect::to('login');}
?>



