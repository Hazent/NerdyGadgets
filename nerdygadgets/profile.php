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

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Mijn gegevens</title>
    <meta charset="UTF-8">
    <style>
        .content {
            position: absolute;
            margin: auto;
            margin-left: 40%;
            margin-top: 2%;
            width: 14%;

            border:1px solid white;
        }

        .address {
            position: absolute;
            margin: auto;
            margin-left: 40%;
            margin-top: 13%;
            width: 14%;


            border:1px solid white;
        }
    </style>
</head>

<body>
<div class="content">
    <h1>Mijn gegevens</h1>
    <br>
    <label for="fullname">Naam:</label> <strong id="fullname"><?php print(" " .$fullname)?></strong>
    <p>Tel nr: <?php print($phonenumber) ?></p>
    <p>email: <?php print($email) ?></p>
    <a href="orders.php">bestelgeschiedenis</a>
    <br>
    <br>
</div>
<br>
<br>
<div class="address" >
    <h2>Adresgegevens</h2>
</div>

</body>

</html>
