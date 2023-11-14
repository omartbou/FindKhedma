<?php
if(isset($_SESSION['logged'])&&$_SESSION['logged']===true){
    if(isset($_SESSION['role'])&&$_SESSION['role']==='manager')
    require_once 'includes/contentsidebar.php';

    $data=new OffersController();
      $requests=$data->selectRequests();
?>
<body>
<div class="wrapper d-flex align-items-stretch">

    <?php require_once 'includes/sidebar.php'?>

<div id="content" class="p-4 p-md-5">
    <?php require_once 'includes/toggle.php';?>
    <div class="container">
        <h2>Requests</h2>
        <table id="dataTable" class="table table-bordered">
            <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Offer Link</th>
                <th>Post Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            <?php if(is_array($requests)){
                foreach($requests as $request):?>
            <tr>
                <td><?php echo $request['fname']." ".$request['lname'] ?></td>
                <td><?php echo $request['email']?></td>
                <td>
                    <a href="#" class="offer-link" style=" color: black;" data-toggle="modal" data-target="#offerModal" data-offer-id="<?php echo $request['offer_id']; ?>"><?php echo $request['title']?></a>
                </td>
                <td><?php echo $request['type_name']?></td>
                <td>
                    <a href="download?file=../uploads/<?php echo $request['resume_file']; ?>" class="fa fa-download" style="margin-right: 25px;" ></a>
                    <a href="chat" class="fa fa-send" style="margin-right: 25px;" ></a>
                </td>
<?php endforeach; } ?>
            </tr>


            <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>
</div>

<div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body" id="offerModalContent"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body" id="offerModalContent">
                <!-- This is where the chat content will be loaded -->
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
    // Define a function to load content into the modal
    $(document).ready(function() {
        // When an offer link is clicked
        $('.offer-link').click(function() {
            var offerId = $(this).data('offer-id');
            var modalContent = $('#offerModalContent');
            // Load the content of offerdetail.php into the modal body
            modalContent.load('offerdetail?offer_id=' + offerId + ' #offerDetailBody');
        });
    });
</script>

</body>
<?php } else{Redirect::to('login');}