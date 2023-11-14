<?php
if(isset($_SESSION['logged'])&&$_SESSION['logged']===true){

    $data=new UserController();
    $user=$data->Profile();
    $updateInfo=$data->updateInfo();
    $updatePassword=$data->updatePassword();
 require_once 'includes/contentsidebar.php';


?>
<body>
<div class="wrapper d-flex align-items-stretch">
    <?php require_once 'includes/sidebar.php' ?>
    <div id="content" class="p-4 p-md-5">

<?php require_once 'includes/toggle.php';?>
        <div class="container"> <div class="card">
                <?php include 'includes/alerts.php'; ?>

                <div class="card-body">

                    <div class="row g-gs">

                        <div class=" col-xxl-6 col-md-2">

                    <form method="POST">
                    <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $user['fname'];?>"><br>
                    <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $user['lname'];?>"><br>

                        <div class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary " name="saveInfo" value="Save">
                        </div>
                    </form>
                        </div>
                        <div class=" col-xxl-6 col-md-3" style="margin-left:40px; ">

                    <form method="POST">
                    <input type="password" class="form-control" name="password" placeholder="New password"><br>
                    <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm password" ><br>
                        <div class="d-flex justify-content-center">
                            <input type="submit" name="saveP" class="btn btn-primary " value="Save">
                        </div>
                    </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>


    </div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

</body>
<?php } else{ Redirect::to('login');}