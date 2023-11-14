<?php
if(isset($_SESSION['logged'])&&$_SESSION['logged']===true) {
    if(isset($_SESSION['role'])&&($_SESSION['role']==='manager'||$_SESSION['role']==='searcher')){
    if ($_SERVER["REQUEST_METHOD"] === "POST") { // Change to GET
        $data = new MessagesController();
        $data->sendMessage();
    } else {
        echo 'bad:(';
    }
}}else{
    Redirect::to('login');
}
?>
