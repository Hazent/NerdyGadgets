<title>Nerdygadgets - Aanpassen</title>

<?php
include __DIR__ . "/header.php";




?>

    <div class="IndexStyle">
        <div class="col-11">
            <div class="Textcontact-admin">
                <div class="TextPrice">

<form action="" method="POST">
    <input type="text" name="phone" placeholder="telefoonnummer"/>
    <input type="text" name="adres" placeholder="address"/>
    <input type="text" name="email" placeholder="email"/>

    <input type="submit" name="update" value="update"/>
</form>

<?php

$host = "localhost";
$databasename = "NerdyGadgets";
$user = "root";
$pass = "";
$port = 3306;
$connection = mysqli_connect($host, $user, $pass, $databasename, $port) or die("badconnect" . mysqli_connect_error());

if(isset($_POST["update"])) {
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $email = $_POST["email"];

    $sql = "update contact set phone = '$phone' , email = '$email' , address = '$address' where id = 1";
    $sql_run = mysqli_query($connection, $sql);

    mysqli_close($connection);
    print"<script>window.location='contact.php'</script>";
}
?>
                    <br>
                </div>
            </div>
        </div>
    </div>



<?php
include __DIR__ . "/footer.php";
?>