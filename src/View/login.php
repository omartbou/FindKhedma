<?php
if(isset($_SESSION['logged'])&&$_SESSION['logged']===true){
    Redirect::to('home');
    }else{

    $data=new LoginController();
    $login=$data->auth();
    $errors=$data->getErrors();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindKhedma</title>
    <link rel="icon" href="images/favicon.png" type="image/gif" />

    <!-- Bootstrap CSS Link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('../images/img-1.png'); /* Replace 'background.jpg' with your image path */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
        }

        .card-title {
            text-align: center;
        }

        .btn-register {
            background-color: #007BFF; /* Blue button color */
            color: #fff;
            border: none;
        }

        .btn-register:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <?php include 'includes/alerts.php'; ?>

                    <h2 class="card-title">Login </h2>

                    <form  method="POST"  >

                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Type your email" required><br>



                        <input type="password" class="form-control" id="password" name="password" placeholder="Type your password" required>
                        </div>
                        <a href="reset-password-request" style="margin-right: 31%">Reset password</a>
                        <span>You're not registred ?</span><a href="register"> Sign up</a><br> <br>
                        <?php if (!empty($errors)): ?>
                            <div class="text-danger">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="text-center">
                            <input type="submit" class="btn btn-register" name="login">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
<?php }?>