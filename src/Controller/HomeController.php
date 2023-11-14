<?php
class HomeController{
    public function index($page){
     include ('View/'.$page.'.php');
    }

}
?>