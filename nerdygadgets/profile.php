<?php require __DIR__ . "/header.php";
require __DIR__ . "/connect.php";?>
<?php

$user_id = $_SESSION["userId"];

$query = "SELECT * FROM people WHERE PersonId = ?";

$Statement = mysqli_prepare($Connection, $query);
mysqli_stmt_bind_param($Statement, "i", $user_id);
mysqli_stmt_execute($Statement);
$Result = mysqli_stmt_get_result($Statement);
$Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);

$firstName = $Result["firstname"];
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
<h1>Profiel</h1>
<div> </div>

</body>
</html>