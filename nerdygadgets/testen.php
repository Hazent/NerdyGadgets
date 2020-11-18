<?php
include __DIR__ . "/header.php";
?>

    <div class="IndexStyle">
        <div class="col-11">
            <div class="TextMain">
                <div class="TextPrice">

<form action="" method="POST">
    <input type="text" name="phone" placeholder="telefoonnummer"/>
    <input type="text" name="email" placeholder="email"/>
    <input type="text" name="address" placeholder="address"/>

    <input type="submit" name="update1" value="update1"/>
</form>

<?php

$host = "localhost";
$databasename = "NerdyGadgets";
$user = "root";
$pass = "";
$port = 3306;
$connection = mysqli_connect($host, $user, $pass, $databasename, $port) or die("badconnect" . mysqli_connect_error());

if(isset($_POST["update1"])) {
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    $sql = "update contact set phone = '$phone' , email = '$email' , address = '$address' where id = 1";
    $sql_run = mysqli_query($connection, $sql);

    mysqli_close($connection);

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