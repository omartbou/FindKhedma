

<?php
require_once 'includes/header.php';
include 'includes/alerts.php';
// Check if the offer details are set as POST data
if(isset($_GET['offer_id'])) {
    $offerId = $_GET['offer_id'];


    // Include any necessary files and classes here

    // Fetch the offer details based on the offer ID (replace this with your actual logic)
    $data = new OffersController();
    $offerDetail = $data->offerDetail($offerId);
    $postResume = $data->uploadResumes();

    // Check if offer details were found
    if ($offerDetail) {
        echo" 
 <div  id='offerDetailBody'>
 <div class='services_section' >
    <div class='container'>
        <h1 class='services_text'>".$offerDetail['title']."</h1>
    </div>
</div>
<div class='companies_section layout_padding'>
    <div class='container'>

<div class='card'>

    <div class='card-body'>
       

         <p class='card-text'>" . $offerDetail['description'] . "</p>
         <p class='card-text'><span style='color:cornflowerblue; font-weight: bold;'>City:</span>  " . $offerDetail['city'] . "</p>
         <p class='card-text'><span style='color:cornflowerblue; font-weight: bold;'>Company Name:</span>  " . $offerDetail['company_name'] . "</p>
         <p class='card-text'><span style='color:cornflowerblue; font-weight: bold;' >Salary: </span>" . $offerDetail['salary'] . " DH</p>
         <p class='card-text'><span style='color:cornflowerblue ;font-weight:bold;'>Date:</span>  " . $offerDetail['updated_at'] . "</p>
             <div class='d-flex justify-content-center'> <!-- Center the button -->
<button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#myModal'>Apply for this offer </button>
</div>
</div>
</div>
</div>
</div>
</div>
";

        }





    } else {
        // Offer details not found
        echo "Offer not found.";
    }


?>



    <!-- The Modal -->
    <div class="modal" id="myModal">

        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Upload your resume</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <?php if (isset($_SESSION['role'])&&$_SESSION['role']==='searcher'){ ?>

                            <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">

                            <label for="fileInput" class="custom-file-label" >Accept just pdf files :</label>
                            <input type="file" class="form-control-file custom-file-input" id="fileInput" name="resume" accept=".pdf">
                            <div class='d-flex justify-content-center'>
                            <input type="submit" class="btn btn-primary " value="Upload">

                            </div>

                        </div>
                            </form>
                    <?php }else{ ?>
                    <a href="login">Sign in</a> please to upload your resume
                    <?php } ?>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
<?php require_once 'includes/footer.php'?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

