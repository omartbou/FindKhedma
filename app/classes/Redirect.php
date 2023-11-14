<?php
class Redirect{
static public function to($page){
    header('Location:'.$page);
}
}
?>