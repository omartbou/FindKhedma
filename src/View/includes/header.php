<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>FindKhedma</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="Omar Bouziani">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- fevicon -->
    <link rel="icon" href="images/favicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesoeet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

</head>
<body>
<!-- header section start-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="logo"><a class="logo" href="home" ><img src="images/logo.png"></a></div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="home">HOME</a>
            </li>
            </li>
                <a class="nav-link" href="companies">COMPANIES</a>
            </li>


        </ul>

    </div>
    <?php if(isset($_SESSION['logged'])&&$_SESSION['logged']===true){?>
    <div class="collapse navbar-collapse" id="navbarNav">




        <li class="nav-item">
        </li>
        <li class="dropdown ">
            <div class="nav-link">
                <i class="fa fa-user"  data-toggle="dropdown" style="font-size:20px; width:100px;" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                </i>
                <ul div class="dropdown-menu" >
        <?php if (isset($_SESSION['role'])&&$_SESSION['role']==='manager') {?>
                    <li><a href="postjob" class="dropdown-item fa fa-cog"> Settings </a></li>

            <?php } else if (isset($_SESSION['role'])&&$_SESSION['role']==='searcher') {?>
                    <li><a href="my-requests" class="dropdown-item fa fa-cog"> Settings </a></li>

                    <?php } else if (isset($_SESSION['role'])&&$_SESSION['role']==='admin'){?>
                    <li><a href="users-management" class="dropdown-item fa fa-cog"> Settings </a></li>
<?php }?>

                    <li><a href="logout" class="dropdown-item fa fa-sign-out"> Logout </a></li>
                </ul>
            </div>
        </li>
    </div>
    <?php } else{?>
    <div class="login_text"><a href="login">LOGIN HERE</a></div>
    <?php }?>
</nav>
