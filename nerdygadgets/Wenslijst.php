<?php

include __DIR__ . "/header.php";

if (empty($_SESSION["wenslijst"])) {
    print ("Wenslijst is leeg, <a href=browse.php>voeg nieuwe producten toe</a>");
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["wenslijst"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["wenslijst"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="wenslijst.php"</script>';
            }
        }
    }
}
if (isset($_GET["submit"])) {
    $count2 = $_GET['number'];
    foreach ($_SESSION["wenslijst"] as $keys => $values) {
        if ($values["item_id"] == $_GET["hidden_id"]) {
            $_SESSION['wenslijst'][$keys]["item_count"] = $count2;
        }
    }
}
foreach ($_SESSION["shopping_cart"] as $keys => $values) {
    $Query = "
                    SELECT  StockItemID, ImagePath
                    FROM stockitemimages";
    $Statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_execute($Statement);
    $Images = mysqli_stmt_get_result($Statement);
    $Images = mysqli_fetch_all($Images, MYSQLI_ASSOC);
}
?>
<?php if (!empty($_SESSION["wenslijst"])) {
?>
    <div class="IndexStyle">
        <table class="BorderWinkelmand">
            <tr>
                <th width="25%">Picture</th>
                <th width="35%">Item Name</th>
                <th width="10%">Price</th>
                <th width="10%">Remove</th>

            </tr>
            <?php }
            if (!empty($_SESSION["wenslijst"])) {
                $total = 0;
                foreach ($_SESSION["wenslijst"] as $keys => $values) {
                    ?>
                    <tr>
                    <td>
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
                        <td>€ <?php echo number_format($values["item_price"], 2); ?></td>
                        <td><a class="DeleteKnop" href="Wenslijst.php?action=delete&id=<?php echo $values['item_id'] ?>">Delete</a></td>
                    </tr>
                    <?php

                }
            }

            ?>
        </table>
    </div>
<?php
include __DIR__ . "/footer.php";
?>