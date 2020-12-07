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

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Profiel</title>
    <meta charset="UTF-8">
    <style>

    </style>
</head>

<body>
<<<<<<< HEAD
<div class="head">
<h1>Profiel van <?php print($fullname) ?></h1>
</div>
<div class="content">
<p>Telefoon nr: <?php print($phonenumber) ?></p>
<p>email: <?php print($email) ?></p>
    <a href="orders.php">Bestelgeschiedenis</a>
 </div>
=======
    <div class="head">
        <h1>Profiel van <?php print($fullname) ?></h1>
    </div>
    <div class="content">
        <p>Telefoon nr: <?php print($phonenumber) ?></p>
        <p>email: <?php print($email) ?></p>
    </div>
    <a href="orders.php">bestelgeschiedenis</a>
>>>>>>> 2876c82601000d6f792d69fae34f5a2fd88de9c2

</body>

</html>