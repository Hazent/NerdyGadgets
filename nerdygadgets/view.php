<title>Nerdygadgets - product</title>
<script src="https://kit.fontawesome.com/3929e16ef5.js" crossorigin="anonymous"></script>
<script src="{% static 'network/functions.js' %}"></script>

<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
include __DIR__ . "/header.php";


// get stockitem
$Query = " 
           SELECT SI.StockItemID, IsChillerStock, 
            (RecommendedRetailPrice*(1+(TaxRate/100))) AS SellPrice, 
            StockItemName,
            CONCAT('Voorraad: ',QuantityOnHand)AS QuantityOnHand,
            SearchDetails, 
            (CASE WHEN (RecommendedRetailPrice*(1+(TaxRate/100))) > 50 THEN 0 ELSE 6.95 END) AS SendCosts, MarketingComments, CustomFields, SI.Video,
            (SELECT ImagePath FROM stockgroups JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = SI.StockItemID LIMIT 1) as BackupImagePath   
            FROM stockitems SI 
            JOIN stockitemholdings SIH USING(stockitemid)
            JOIN stockitemstockgroups ON SI.StockItemID = stockitemstockgroups.StockItemID
            JOIN stockgroups USING(StockGroupID)
            WHERE SI.stockitemid = ?
            GROUP BY StockItemID";

$Statement = mysqli_prepare($Connection, $Query);
mysqli_stmt_bind_param($Statement, "i", $_GET['id']);
mysqli_stmt_execute($Statement);
$ReturnableResult = mysqli_stmt_get_result($Statement);
if ($ReturnableResult && mysqli_num_rows($ReturnableResult) == 1) {
    $Result = mysqli_fetch_all($ReturnableResult, MYSQLI_ASSOC)[0];
} else {
    $Result = null;
}

//Get Images
$Query = "
                SELECT ImagePath
                FROM stockitemimages 
                WHERE StockItemID = ?";

$Statement = mysqli_prepare($Connection, $Query);
mysqli_stmt_bind_param($Statement, "i", $_GET['id']);
mysqli_stmt_execute($Statement);
$R = mysqli_stmt_get_result($Statement);
$R = mysqli_fetch_all($R, MYSQLI_ASSOC);

if ($R) {
    $Images = $R;
}
if(isset($_POST["wenslijst"]) || isset($_GET['action'])){
    if(isset($_SESSION["wenslijst"]) || $_GET['action'] == 'wish'){
        $item_array_id2 = array_column($_SESSION["wenslijst"], "item_id");
        if(!in_array($Result["StockItemID"], $item_array_id2)){
            $count2 = count($_SESSION["wenslijst"]);
            $item_array2 = array(
                'item_id' => $Result['StockItemID'],
                //'item_picture' => $Images[0],
                'item_name' => $Result['StockItemName'],
                'item_price' => $Result['SellPrice']
            );
            $_SESSION["wenslijst"][$count2] = $item_array2;
            echo '<script>alert("Product Toegevoegd")</script>';
        }else{
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="Wenslijst.php"</script>';
        }
    } else{
        $item_array2 = array(
            'item_id' => $Result["StockItemID"],
            //'item_picture' => $Images[0],
            'item_name' => $Result['StockItemName'],
            'item_price' => $Result['SellPrice']
        );
        $_SESSION['wenslijst'][0] = $item_array2;
        echo '<script>alert("Product Toegevoegd")</script>';
    }
}
if(isset($_POST["toevoegen"])){
    if(isset($_SESSION["shopping_cart"])){
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($Result["StockItemID"], $item_array_id)){
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id' => $Result['StockItemID'],
//                'item_picture' => $Image['ImagePath'],
                'item_name' => $Result['StockItemName'],
                'item_price' => $_POST['hiddenPrice'],
                'item_count' => $_POST['count']
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
            echo '<script>alert("Product Toegevoegd")</script>';
        }else{
            echo '<script>alert("Product is al toegevoegd")</script>';
            echo '<script>window.location="winkelmand.php"</script>';
        }
    } else{
        $item_array = array(
                'item_id' => $Result["StockItemID"],
//                'item_picture' => $Image['ImagePath'],
                'item_name' => $Result['StockItemName'],
                'item_price' => $_POST['hiddenPrice'],
                'item_count' => $_POST['count']
        );
        $_SESSION['shopping_cart'][0] = $item_array;
        echo '<script>alert("Product Toegevoegd")</script>';
    }
}
?>
<div id="CenteredContent">
    <?php
    if ($Result != null) {
        ?>
        <?php
        if (isset($Result['Video'])) {
            ?>
            <div id="VideoFrame">
                <?php print $Result['Video']; ?>
            </div>
        <?php }
        ?>


        <div id="ArticleHeader">
            <?php
            if (isset($Images)) {
                // print Single
                if (count($Images) == 1) {
                    ?>
                    <div id="ImageFrame"
                         style="background-image: url('Public/StockItemIMG/<?php print $Images[0]['ImagePath']; ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;"></div>
                    <?php
                } else if (count($Images) >= 2) { ?>
                    <div id="ImageFrame">
                        <div id="ImageCarousel" class="carousel slide" data-interval="false">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <?php for ($i = 0; $i < count($Images); $i++) {
                                    ?>
                                    <li data-target="#ImageCarousel"
                                        data-slide-to="<?php print $i ?>" <?php print (($i == 0) ? 'class="active"' : ''); ?>></li>
                                    <?php
                                } ?>
                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                <?php for ($i = 0; $i < count($Images); $i++) {
                                    ?>
                                    <div class="carousel-item <?php print ($i == 0) ? 'active' : ''; ?>">
                                        <img src="Public/StockItemIMG/<?php print $Images[$i]['ImagePath'] ?>">
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#ImageCarousel" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#ImageCarousel" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div id="ImageFrame"
                     style="background-image: url('Public/StockGroupIMG/<?php print $Result['BackupImagePath']; ?>'); background-size: cover;"></div>
                <?php
            }
            ?>


            <h1 class="StockItemID">Artikelnummer: <?php print $Result["StockItemID"]; ?></h1>
            <h2 class="StockItemNameViewSize StockItemName">
                <?php print $Result['StockItemName']; ?>
            </h2>
            <div class="QuantityText"><?php print $Result['QuantityOnHand']; ?></div>
            <?php if ($Result['IsChillerStock']) {
                $Query = "
                SELECT Temperature
                FROM coldroomtemperatures
                WHERE ColdRoomSensorNumber = 1";

                $Statement = mysqli_prepare($Connection, $Query);
                mysqli_stmt_execute($Statement);
                $temp = mysqli_stmt_get_result($Statement);
                $temp = mysqli_fetch_all($temp, MYSQLI_ASSOC);
                foreach ($temp as $koud => $kouder) {
                    print ("Temperatuur: " . $kouder['Temperature'] . " °C");
                }
            }?>
            <div id="StockItemHeaderLeft">
                <div class="CenterPriceLeft">
                    <div class="CenterPriceLeftChild">
                        <p class="StockItemPriceText"><b><?php print sprintf("€ %.2f", $Result['SellPrice']); ?></b></p>
                        <h6> Inclusief BTW </h6>
                        <form method="post" action="view.php?id=<?php echo $Result['StockItemID']?>">
                            <select name="count">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <input type="hidden" name="hiddenName" value="<?php print $Result['StockItemName'];?>">
                            <input type="hidden" name="hiddenPrice" value="<?php print $Result['SellPrice'];?>">
                            <input class="ToevoegenKnop" type="submit" name="toevoegen" value="Toevoegen aan Winkelmand">
                        </form>
                        <div class="h_container">
                            <a href="view.php?id=<?php echo $Result['StockItemID']?>&action=wish"><i id="heart" class="far fa-heart">  </i></a>
                        </div>
                        <br>
                        <br>
                     <div class="rainbow">
                        <script type="text/javascript">
                            (function() {
                                var blinks = document.getElementsByTagName('blink');
                                var visibility = 'hidden';
                                window.setInterval(function() {
                                    for (var i = blinks.length - 1; i >= 0; i--) {
                                        blinks[i].style.visibility = visibility;
                                    }
                                    visibility = (visibility === 'visible') ? 'hidden' : 'visible';
                                }, 250);
                            })();
                        </script>
                        <strong> <?php $rand = rand(10, 30); print $rand?>  mensen kijken naar dit product! </strong>
                     </div>

                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div id="StockItemDescription">
            <h3>Artikel beschrijving</h3>
            <p><?php print $Result['SearchDetails']; ?></p>
            <h5>Bestel voor 18.00 en krijg je bestelling MORGEN in huis!</h5>

        </div>
        <div id="StockItemSpecifications">
            <h3>Artikel specificaties</h3>
            <?php
            $CustomFields = json_decode($Result['CustomFields'], true);
            if (is_array($CustomFields)) { ?>
                <table>
                <thead>
                <th>Naam</th>
                <th>Data</th>
                </thead>
                <?php
                foreach ($CustomFields as $SpecName => $SpecText) { ?>
                    <tr>
                        <td>
                            <?php print $SpecName; ?>
                        </td>
                        <td>
                            <?php
                            if (is_array($SpecText)) {
                                foreach ($SpecText as $SubText) {
                                    print $SubText . " ";
                                }
                            } else {
                                print $SpecText;
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </table><?php
            } else { ?>

                <p><?php print $Result['CustomFields']; ?>.</p>
                <?php
            }
            ?>
        </div>
        <?php
    } else {
        ?><h2 id="ProductNotFound">Het opgevraagde product is niet gevonden.</h2><?php
    } ?>
</div>
