<?php
if (isset($_SESSION['logged'])&&$_SESSION['logged']===true) {


    session_destroy();
    Redirect::to('home');
    }else{
    echo ':(';
}
?>