<?php
include __DIR__ . "/header.php";

//JOIN orderlines ON orders.OrderID = orderlines.OrderID
$Query = "
SELECT * FROM orders
JOIN orderlines ON orders.OrderID = orderlines.OrderID
WHERE `orders`.`CustomerID` = 1060";
$Statement = mysqli_prepare($Connection, $Query);
mysqli_stmt_execute($Statement);
$Result = mysqli_stmt_get_result($Statement);
$rows = mysqli_fetch_all($Result, MYSQLI_ASSOC);

?>
<div class="IndexStyle" style="overflow: auto;">
    <div class="col-11">
    <table class="table table-striped" style="color: white !important;">
    <thead>

      
      <?php




                echo "<tr>";
                foreach($rows[0] as $key => $value){
                    echo "<th scope='col'>".$key."</th>";
                }
                    
                echo "</tr> ";
            


        ?>

  </thead>
  <tbody>

  

        <?php



            foreach ($rows as $row) {
                echo "<tr>";
                foreach($row as $key => $value){
                    echo "<td>".$value."</td>";
                }
                    
                echo "</tr> ";
            }

        ?>
  </tbody>
</table>
       

    </div>
</div>
<?php
include __DIR__ . "/footer.php";
?>