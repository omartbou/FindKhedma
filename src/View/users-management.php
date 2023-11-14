<?php
if(isset($_SESSION['logged'])&&$_SESSION['logged']===true){
    if(isset($_SESSION['role'])&&$_SESSION['role']==='admin'){

$data=new UserController();
$users=$data->displayUsers();
require_once 'includes/contentsidebar.php';

?>

    <body>
    <div class="wrapper d-flex align-items-stretch">

        <?php require_once 'includes/sidebar.php'?>

        <div id="content" class="p-4 p-md-5">
            <?php require_once 'includes/toggle.php';?>
            <div class="container">
                <h2>Users Management</h2>
                <table id="dataTable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if(is_array($users)){
                    foreach($users as $row):?>
                    <tr>
                        <td><?php echo $row['fname']." ".$row['lname'] ?></td>
                        <td><?php echo $row['email']?></td>
                        <td><?php echo $row['role']?></td>
                        <td>
                            <a href="#"  style="margin-right: 25px;"  data-toggle="modal" data-target="#userModal" class="user-link fa fa-edit" data-user-id="<?php echo $row['id'];?>"></a>
                            <a href="delete-user?userId=<?php echo $row['id'];?>" class="fa fa-trash" style="margin-right: 25px;" class="fa fa-trash"></a>
                        </td>
                        <?php endforeach; } ?>
                    </tr>


                    <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body" id="updateModalContent"></div>
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

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.user-link').click(function() {
                var userId = $(this).data('user-id');
                var modalContent = $('#updateModalContent');
                modalContent.load('update-user?userId=' + userId);
            });
        });

    </script>

    </body>
<?php }} else{ Redirect::to('home');} ?>