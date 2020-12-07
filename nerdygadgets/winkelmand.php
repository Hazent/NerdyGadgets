<title>Nerdygadgets - Winkelmand</title>

<?php
include __DIR__ . "/header.php";

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="winkelmand.php"</script>';
            }
        }
    }
}
if (isset($_GET["submit"])) {
    $count = $_GET['number'];
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        if ($values["item_id"] == $_GET["hidden_id"]) {
            $_SESSION['shopping_cart'][$keys]["item_count"] = $count;
            echo "<script>window.location='winkelmand.php'</script>";
        }
    }
}

?>
<?php if (!empty($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        $Query = "
                    SELECT  StockItemID, ImagePath
                    FROM stockitemimages";
        $Statement = mysqli_prepare($Connection, $Query);
        mysqli_stmt_execute($Statement);
        $Images = mysqli_stmt_get_result($Statement);
        $Images = mysqli_fetch_all($Images, MYSQLI_ASSOC);
    }?>
<div class="IndexStyle">
    <table class="BorderWinkelmand">
        <tr>
            <th width="25%">Foto</th>
            <th width="35%">Product</th>
            <th width="15%">Levertijd (dagen)</th>
            <th width="5%">Aantal</th>
            <th width="10%">Prijs</th>
            <th width="20%">Totaal</th>
            <th width="10%">Verwijder</th>
            <th width="10%">Aanpassen</th>
        </tr>
<?php } ?>
        <?php
        if (!empty($_SESSION["shopping_cart"])) {
            $total = 0;
            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        ?>
                <tr>
                    <td
                            <?php
                            foreach ($Images as $regel => $data) {
                                if (isset($Images)) {
                                    if ($data["StockItemID"] == $values["item_id"]) {
                                    ?>
                                        <div id="ImageFrame"
                                            style="background-image: url('Public/StockItemIMG/<?php print $data["ImagePath"]; ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;"></div>
                                    <?php
                                    }
                                } else {
                                ?>
                                    <div id="ImageFrame"
                                        <?php print("<img src='NoImage.png'>"); ?></div>
                                <?php }
                                }
                                ?>
                    </td>
                    <td><?php echo $values["item_name"]; ?></td>
                    <td><?php echo rand(1,7) ?></td>
                    <td><?php echo $values["item_count"]; ?></td>
                    <td>€ <?php echo number_format($values["item_price"], 2); ?></td>
                    <td>€ <?php echo number_format($values["item_price"] * $values["item_count"], 2); ?></td>
                    <td><a class="DeleteKnop" href="winkelmand.php?action=delete&id=<?php echo $values['item_id'] ?>">Verwijder</a></td>
                    <td>
                        <form method="get" name="Change">
                            <input id="id_form-0-quantity" min="0" max="100" name="number" value="<?php print($values['item_count']);?>" type="number">
                            <input type="hidden" name="hidden_id" value="<?php print($values['item_id']);?>">
                            <input type="submit" name="submit" value="Aantal aanpassen">
                        </form>
                    </td>
                </tr>
        <?php
                $verzendkosten = 5.65;
                $total = $total + ($values["item_price"] * $values["item_count"] + $verzendkosten);
            }
                $subtotaal = ($total - $verzendkosten);
        } else {
            $total = 0;
        }
        ?>
    </table>
    <?php if (!empty($_SESSION["shopping_cart"])) { ?>
    <table class="total_table">
        <td>
            <br>
            <?php
            print ("Subtotaal: € " . number_format($subtotaal, 2) . " <br>");
            print ("Verzendkosten: € $verzendkosten <br>");
            ?>
            ---------------------------------------
            <br> 
            <strong>Totaal Prijs: € <?php echo number_format($total, 2); ?> </strong>
            <br>
            <br>
            <a class="btn btn-primary btn-lg active" href="checkout.php">Afrekenen</a>
        </td>
    </table>
    <?php } ?>
    <div class="WinkelMandLeeg">
        <?php if (empty($_SESSION["shopping_cart"])) {
        print ("Winkelmand is leeg, <a href=browse.php>voeg nieuwe producten toe</a>");
        }
        ?>
    </div>
</div>
<?php
include __DIR__ . "/footer.php";
?>