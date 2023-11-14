<?php if (isset($_SESSION['logged'])&&$_SESSION['logged']===true){
       if(isset($_SESSION['role'])&&$_SESSION['role']==='admin'){
       $data=new UserController();
       $data->deleteUser();}}else{Redirect::to('home');}?>

