<?php
if(isset($_GET['token'])){
$data=new ResetPasswordController();

    $resetPassword = $data->resetPassword($_POST);

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

    <body>
    <div class="container">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
    <h2 class="text-center">Set New Password</h2>

<form  method="post">
    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">

    <label for="password">New Password:</label>
    <input type="password" id="password" name="password" required  class="form-control"><br>

    <label for="confirm_password" >Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required><br>
<div class="text-center">
    <button type="submit" class="btn btn-register">Set New Password</button>
</div>
</form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<?php }else{ Redirect::to('login'); }?>