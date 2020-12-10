<title>Nerdygadgets - Geslaagd</title>

<?php
include __DIR__ . "/header.php";
?>
<?php
if (!empty($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        $itemid = $values['item_id'];
        $selectquery = "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ?";
        $Stmt = mysqli_prepare($Connection, $selectquery);
        mysqli_stmt_bind_param($Stmt, "i", $itemid);
        mysqli_stmt_execute($Stmt);
        $SResult = mysqli_stmt_get_result($Stmt);
        $SelectResult = mysqli_fetch_all($SResult, MYSQLI_ASSOC);
        $selectarray = $SelectResult[0];
        $dbitemcount = $selectarray["QuantityOnHand"];

        $currentitems = $values["item_count"];
        $finalvalue = $dbitemcount - $currentitems;

        $updatequery = "UPDATE stockitemholdings SET QuantityOnHand = ? WHERE StockItemID = ?";
        $Statement = mysqli_prepare($Connection, $updatequery);
        mysqli_stmt_bind_param($Statement, "ii", $finalvalue, $itemid);
        mysqli_stmt_execute($Statement);
        sleep(2);
        echo '<script>window.location="index.php"</script>';
    }
}
?>
<div class="IndexStyle">
    <div class="col-11">

<h1>Uw bestelling is succesvol afgerond!</h1>

    </div>
</div>
<?php
include __DIR__ . "/footer.php";
?>