<title>Nerdygadgets - Profiel</title>

<?php require __DIR__ . "/header.php";
require __DIR__ . "/connect.php"; ?>
<?php

$user_id = $_SESSION["personId"];

$query = "SELECT * FROM people WHERE PersonId = ?";

$Statement = mysqli_prepare($Connection, $query);
mysqli_stmt_bind_param($Statement, "i", $user_id);
mysqli_stmt_execute($Statement);
$Result = mysqli_stmt_get_result($Statement);
$Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);
$array = $Result[0];
$fullname = $array["FullName"];
$phonenumber = $array["PhoneNumber"];
$email = $array["EmailAddress"];

$selectCustomer = "SELECT * FROM Customers WHERE PrimaryContactPersonID = ?";
$Stmnt = mysqli_prepare($Connection, $selectCustomer);
mysqli_stmt_bind_param($Stmnt, "i", $user_id);
mysqli_stmt_execute($Stmnt);
$customerResult = mysqli_stmt_get_result($Stmnt);
$customer = mysqli_fetch_all($customerResult, MYSQLI_ASSOC);
$customerarray = $customer[0];

$city = $customerarray["DeliveryAddressLine1"];
$address = $customerarray["DeliveryAddressLine2"];
$postalcode = $customerarray["DeliveryPostalCode"];

if(isset($_GET['submit'])){
    unset($_SESSION['personName']);
    unset($_SESSION['personId']);
    echo "<script>alert('U bent uitgeloggd')</script>";
    echo "<script>window.location='index.php'</script>";
}
?>
<style>
    .content1 {
        position: absolute;
        margin: auto;

        margin-left: 40%;
        margin-top: 2%;
        width: 20%;

        border:1px solid white;
    }
</style>
<div class="content1">
    <h1>Mijn gegevens</h1>
    <br>
    <label for="fullname">Naam:</label> <strong id="fullname"><?php print(" " .$fullname)?></strong>
    <p>Tel nr: <?php print($phonenumber) ?></p>
    <p>E-Mail: <?php print($email) ?></p>
    <a href="orders.php">Bestelgeschiedenis</a>
    <br>
    <br>
    <h2>Adresgegevens</h2>
    <p>Straat: <?php print($address); ?></p>
    <p>Stad: <?php print($city); ?></p>
    <p>Postcode: <?php print($postalcode)?></p>
    <br>
    <form name="LogUit">
        <button class="ToevoegenKnop" type="submit" name="submit" style="text-algin: center;">Uitloggen</button>
    </form>
</div>
<br>
<br>

<?php require __DIR__ . "./footer.php"; ?>
