<?php
require_once './Controller/HomeController.php';
require_once './autoload.php';

$home = new HomeController();
$pages = ['home', 'offerdetail','register','getmessages','login','logout','companies','postjob','requests','download','my-offers','delete-offer','chat','sendmessage','profile','reset-password-request','reset-password','update-user','users-management','my-requests'];

if (isset($_GET['page'])) {
    if (in_array($_GET['page'], $pages)) {
        $page = $_GET['page'];

        $home->index($page);
    } else {
        echo '404';
    }
} else {
    $home->index('home');
}