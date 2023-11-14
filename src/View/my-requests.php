<?php
      if(isset($_SESSION['logged'])&&$_SESSION['logged']===true){
      if(isset($_SESSION['role'])&&$_SESSION['role']==='searcher'){

      $data=new OffersController();
      $myrequests=$data->myRequest();
      require_once 'includes/contentsidebar.php';
?>
<div class="wrapper d-flex align-items-stretch">
    <?php require_once 'includes/sidebar.php';?>
      <div class="container">
          <div id="content" class="p-4 p-md-5">
          <?php require_once 'includes/toggle.php'; ?>
          <table id="dataTable" class="table table-bordered">
                  <thead>
                  <tr>
                        <th>Title</th>
                        <th>Post Type </th>
                        <th>Company Name </th>

                  </tr>
                  </thead>
                  <tbody>

                  <?php if(is_array($myrequests)){
                  foreach($myrequests as $row):?>
                  <tr>
                        <td>
                              <a href="#" class="offer-link" style=" color: black;" data-toggle="modal" data-target="#offerModal" data-offer-id="<?php echo $row['offer_id']; ?>"><?php echo $row['title']?></a>
                        </td>
                        <td><?php echo $row['type_name']?></td>
                        <td><?php echo $row['company_name']?></td>

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
<?php } } else Redirect::to('home');?>