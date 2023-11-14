
<style>
    .logo {
        text-align: center; /* Center the logo horizontally */
    }

    .logo-link {
        text-decoration: none; /* Remove underlines from the link */
    }

    .logo img {
        width:100%; /* Adjust the width of the logo image */
        height: auto; /* Maintain the aspect ratio of the logo */
        display: block; /* Remove any extra spacing around the image */
    }
</style>
    <nav id="sidebar">
        <div class="p-4 pt-5">
            <div class="logo">
                <a class="logo-link" href="home">
                    <img src="images/logo-sidebar.png" alt="Logo">
                </a>
            </div>            <ul class="list-unstyled components mb-5">
                <?php  if(isset($_SESSION['role'])&&$_SESSION['role']==='manager'){?>

                    <li>
                    <a href="postjob">Post Job</a>
                </li>
               <li>
                    <a href="requests">Requests</a>
                </li>
                <li>
                    <a href="my-offers">My Offers</a>
                </li>
                <?php } else if(isset($_SESSION['role'])&&$_SESSION['role']==='searcher'){?>
                    <li>
                        <a href="my-requests">My requests</a>
                    </li>

                <?php }  if (isset($_SESSION['role']) && ($_SESSION['role'] === 'searcher' || $_SESSION['role'] === 'manager')) {?>
                <li>
                    <a href="chat">Messages</a>
                </li>
                    <?php } ?>
                <?php   if(isset($_SESSION['role'])&&$_SESSION['role']==='admin'){ ?>

                <li>
                    <a href="users-management">Users Management</a>
                </li>
                <?php } ?>
                <li>
                    <a href="profile">Profile</a>
                </li>
                <li>
                    <a href="home">Go Back</a>
                </li>
                <li>
                    <a href="logout">Logout</a>
                </li>
            </ul>


        </div>
    </nav>

    <!-- Page Content  -->



