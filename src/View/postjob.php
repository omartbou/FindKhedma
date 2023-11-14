<?php
if(isset($_SESSION['logged'])&&$_SESSION['logged']===true){
    if(isset($_SESSION['role'])&&$_SESSION['role']==='manager'){

$data =new OffersController();
$posttype=$data->getPostType();
$ocontent=$data->content();
?>
<?php require_once 'includes/contentsidebar.php';?>
<body>
<div class="wrapper d-flex align-items-stretch">

<?php require_once 'includes/sidebar.php'?>
<div id="content" class="p-4 p-md-5">
    <?php require_once 'includes/toggle.php';?>


<form  method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
    <?php include 'includes/alerts.php'; ?>

    <input type="text" class="form-control" name="title" placeholder="Title" required><br>
    <select class="form-control" name="post_type" >
        <option selected disabled>Choose  post </option>
        <?php foreach( $posttype as $type_name):?>
        <option value="<?php echo $type_name['id'] ?>" ><?php echo $type_name['type_name']?></option>
        <?php endforeach;?>
    </select><br>
 <input type="number"min="0" class="form-control" name="salary" placeholder="Salary"><br>
    <input type="text" class="form-control" name="city" placeholder="City" required><br>
    <input type="text" class="form-control" name="company" placeholder="Company name" required><br>
<textarea name="editor_content" class="form-control" required ></textarea><br>

    <button type="submit" name="submit" class="btn btn-primary" >Save Content</button>

</form>
</div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
<?php }} else{Redirect::to('login');} ?>