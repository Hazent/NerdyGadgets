<?php
include __DIR__ . "/header.php";

if(isset($_GET["action"])){
    if($_GET["action"] == "delete"){
        foreach ($_SESSION["shopping_cart"] as $keys => $values){
            if($values["item_id"] == $_GET["id"]){
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="winkelmand.php"</script>';
            }
        }
    }
}
?>
<div class="IndexStyle">
    <table>
        <tr>
            <th width="40%">Picture</th>
            <th width="40%">Item Name</th>
            <th width="10%">Quantity</th>
            <th width="20%">Price</th>
            <th width="15%">Total</th>
            <th width="5%">Action</th>
        </tr>
        <?php
        if(!empty($_SESSION["shopping_cart"]))
        {
            $total = 0;
            foreach ($_SESSION["shopping_cart"] as $keys => $values)
            {
                ?>
                <tr>
                    <td><?php echo $values["item_picture"];?></td>
                    <td><?php echo $values["item_name"]; ?></td>
                    <td><?php echo $values["item_count"]; ?></td>
                    <td>€ <?php echo number_format($values["item_price"], 2); ?></td>
                    <td>€ <?php echo number_format($values["item_price"] * $values["item_count"], 2); ?></td>
                    <td><a href="winkelmand.php?action=delete&id=<?php echo $values['item_id']?>">Delete</a> <a href="winkelmand.php?action=quantity&id=<?php echo $values['item_id']?>">Change</a></td>
                </tr>
                <?php
                $total = $total + ($values["item_price"] * $values["item_count"]);
            }
        }
        ?>
    </table>
    Total Price: € <?php print number_format($total, 2);?>
</div>
<?php
include __DIR__ . "/footer.php";
?>