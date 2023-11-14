<?php
$offersPerPage = 10;



if(isset($_POST['find'])){
    $data = new OffersController();
    $offers = $data->findOffers($_POST);

}else {
    $data = new OffersController();
    $offers = $data->OffersList();
}
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;

// Calculate the offset for the SQL query
$offset = ($page - 1) * $offersPerPage;

// Slice the array to display only the relevant offers for the current page
$paginatedOffers = array_slice($offers, $offset, $offersPerPage);

// Total number of offers
$totalOffers = count($offers);

// Total number of pages
$totalPages = ceil($totalOffers / $offersPerPage);
?>
<?php
require_once 'includes/header.php';
?>

<div class="banner_section layout_padding">
    <div class="container">
        <h1 class="best_taital">Find your job here </h1>
        <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">

        <div class="box_main">
            <input type="text" class="email_bt" placeholder="Search Job" name="search_offers">
            <input type="text" id="cityInput" list="cities" name="search_cities" placeholder="Type a city...">
            <datalist id="cities">
                <option value="casablanca">Casablanca</option>
                <option value="rabat">Rabat</option>
                <option value="marrakech">Marrakech</option>
                <option value="fes">Fes</option>
                <option value="agadir">Agadir</option>
                <option value="tangier">Tangier</option>
                <option value="meknes">Meknes</option>
                <option value="oujda">Oujda</option>
                <option value="essaouira">Essaouira</option>
                <option value="fez">Fez</option>
                <option value="kenitra">Kenitra</option>
                <option value="tétouan">Tétouan</option>
                <option value="taza">Taza</option>
                <option value="larache">Larache</option>
                <option value="el jadida">El Jadida</option>
                <option value="nador">Nador</option>
                <option value="safi">Safi</option>
                <option value="berkane">Berkane</option>
                <option value="beni mellal">Beni Mellal</option>
                <option value="taroudant">Taroudant</option>
                <option value="settat">Settat</option>
                <option value="tiflet">Tiflet</option>
                <option value="khemisset">Khemisset</option>
                <option value="guelmim">Guelmim</option>
                <option value="taounate">Taounate</option>
                <option value="tafraout">Tafraout</option>
                <option value="ouarzazate">Ouarzazate</option>
                <option value="zagora">Zagora</option>
                <option value="asfi">Asfi</option>
                <option value="tan tan">Tan Tan</option>
                <option value="ben guerir">Ben Guerir</option>
                <option value="khouribga">Khouribga</option>
                <option value="berrechid">Berrechid</option>
                <option value="oued zem">Oued Zem</option>
                <option value="fnideq">Fnideq</option>
                <option value="sidi slimane">Sidi Slimane</option>
                <option value="tiznit">Tiznit</option>
                <option value="martil">Martil</option>
                <option value="khemis sahel">Khemis Sahel</option>
                <option value="sidi kacem">Sidi Kacem</option>
                <option value="el aioun">El Aioun</option>
                <option value="sidi bennour">Sidi Bennour</option>
                <option value="taaracht">Taaracht</option>
                <option value="aïn harrouda">Aïn Harrouda</option>
            </datalist>
            <button class="subscribe_bt" type="submit" name="find">Search</button>

        </div>

        </form>

        </div>
        <p class="there_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alterationThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p>

    </div>
</div>


<div class="job_section ">

<div class=" col-md-6  ">
    <h2 class="text-center">Job Listings</h2>
    <h5 class="text-right"><?php echo count($offers) ?> offers</h5>
    <?php foreach ($paginatedOffers as $offer) : ?>

    <div class="card " >

        <div class="card-body">
                <?php  if (empty($offer)) {
                    echo "No Offers found.";
                }?>


                <a href="offerdetail?offer_id=<?php echo $offer['id']?>" class="offer-link" >
                    <em style="font-size: 18px;" class="icon ni ni-eye"></em>
                    <h3 class="card-title"><span class="text-success">Offer Title : </span><?php echo $offer['title'] ?></h3>
                    <p class="card-test" style="font-weight:bold;">
                        <?php $content=$offer['description'];
                        if(strlen($content)>200){
                            $truncatedtext=substr($content,0,200);
                            $truncatedtext.='...';
                            echo strip_tags($truncatedtext);

                        }else{
                            echo strip_tags($content);
                        }
                        ?>
                    </p>
                    <p class="card-text">Company: <?php echo $offer['company_name'] ?></p>
                    <p class="card-text"> <?php echo $offer['created_at'] ?></p>
                </a>



        </div>


    </div><br>
    <?php endforeach; ?>
    <div class="text-center">
        <ul class="pagination">
            <?php if ($page > 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="?p=<?php echo $page - 1; ?>">Previous</a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?p=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($page < $totalPages) : ?>
                <li class="page-item">
                    <a class="page-link" href="?p=<?php echo $page + 1; ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
</div>


<?php require_once 'includes/footer.php'?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>