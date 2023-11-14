<?php
$data=new ResetPasswordController();
$reset=$data->resetRequestPassword();
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
<form method="POST">
    <?php include 'includes/alerts.php';?>
<input type="text" name="email" class="form-control" placeholder="Email"><br>
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