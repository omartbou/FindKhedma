<?php
if(isset($_SESSION['logged'])&&$_SESSION['logged']===true){
if(isset($_SESSION['role'])&&$_SESSION['role']==='admin'){

      $data=new UserController();
      $update=$data->updateUser();
      $user=$data->getUserById();

?>
<form method="POST">
    <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $user['fname'];?>"><br>
    <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $user['lname'];?>"><br>
    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $user['email']?>"><br>
    <input type="submit" class="form-control"><br>

</form>
<?php }} else {Redirect::to('home');}?>