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
        }
    }
}
?>
<div class="IndexStyle">
    <table class="BorderWinkelmand">
        <tr>
            <th width="25%">Picture</th>
            <th width="40%">Item Name</th>
            <th width="5%">Quantity</th>
            <th width="20%">Price</th>
            <th width="20%">Total</th>
            <th width="10%">Remove</th>
            <th width="10%">Change</th>
        </tr>
        <?php
        if (!empty($_SESSION["shopping_cart"])) {
            $total = 0;
            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        ?>
                <tr>
                    <td>Picture</td>
                    <td><?php echo $values["item_name"]; ?></td>
                    <td><?php echo $values["item_count"]; ?></td>
                    <td>€ <?php echo number_format($values["item_price"], 2); ?></td>
                    <td>€ <?php echo number_format($values["item_price"] * $values["item_count"], 2); ?></td>
                    <td><a class="DeleteKnop" href="winkelmand.php?action=delete&id=<?php echo $values['item_id'] ?>">Delete</a></td>
                    <td>
                        <form method="get" name="change">
                            <input type="hidden" name="hidden_id" value="<?php echo $values["item_id"]; ?>">
                            <select name="number">
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
                            <input type="submit" name="submit" value="Change">
                        </form>
                    </td>
                </tr>
        <?php
                $total = $total + ($values["item_price"] * $values["item_count"]);
            }
        } else {
            $total = 0;
        }
        ?>
    </table>
    <table class="total_table">
        <td>
            <br>
            Verzendkosten: € 5,65 
            <br> 
            Total Price: € <?php echo number_format($total, 2); ?> 
            <br>
            <br>
            <a class="btn btn-primary btn-lg active" href="checkout.php">Afrekenen</a>
        </td>
    </table>
</div>
<?php
include __DIR__ . "/footer.php";
?>