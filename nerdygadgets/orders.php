<?php
include __DIR__ . "/header.php";

//JOIN orderlines ON orders.OrderID = orderlines.OrderID
$Query = "
SELECT * FROM orders
WHERE `orders`.`CustomerID` = 1060
ORDER BY OrderDate DESC";
$Statement = mysqli_prepare($Connection, $Query);
mysqli_stmt_execute($Statement);
$Result = mysqli_stmt_get_result($Statement);
$orders = mysqli_fetch_all($Result, MYSQLI_ASSOC);

?>
<div class="IndexStyle" style="overflow: auto;">
    <div class="col-11">

        <?php

        foreach ($orders as $order) {
            $total = 0;
            $Query = "
                SELECT * FROM orderlines
                WHERE OrderID = " . $order['OrderID'];
            $Statement = mysqli_prepare($Connection, $Query);
            mysqli_stmt_execute($Statement);
            $Result = mysqli_stmt_get_result($Statement);
            $orderlines = mysqli_fetch_all($Result, MYSQLI_ASSOC);

            echo $order['OrderDate'].'
            <table class="table table-striped" style="color: white !important;">
                <thead>
                    <th >Aantal</th>
                    <th >Product</th>
                    <th >Prijs</th>

                </thead>
                <tbody>';







            foreach ($orderlines as $row) {
                $total = $total + $row["Quantity"]*$row["UnitPrice"];
                echo "<tr>";
                
                echo "<td>" . $row["Quantity"] . "x</td>";
                echo "<td>" . $row["Description"] . "</td>";
                echo "<td>€" . $row["Quantity"]*$row["UnitPrice"] . "</td>";

                echo "</tr> ";
            }

            echo "<tr>";
            echo "<td ></td>";
            echo "<td ></td>";

            echo "<td >€" . $total . "</td>";

            echo "</tr> ";
            echo '
            </tbody>
        </table>
        <br/>
        <br/>

        ';
        }

        ?>



    </div>
</div>
<?php
include __DIR__ . "/footer.php";
?>