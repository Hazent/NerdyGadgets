<?php
include __DIR__ . "/header.php";

$host = "localhost";
$databasename = "NerdyGadgets";
$user = "root";
$pass = "";
$port = 3306;
$connection = mysqli_connect($host, $user, $pass, $databasename, $port) or die("badconnect" . mysqli_connect_error());




$sql = "SELECT * FROM contact";
$result = mysqli_query($connection, $sql);

$contacts = mysqli_fetch_all($result,MYSQLI_ASSOC);

foreach($contacts as $contact){
    $phone = $contact["phone"];
    $adres = $contact["address"];
    $email = $contact["email"];
}

?>

<div class="IndexStyle">
    <div class="col-11">
        <div class="Textcontact">
            <div class="TextPrice">
            telefoonnummer: <?php print $phone;?>
            <br>
            email: <?php print $email;?>
            <br>
            addres: <?php print $adres;?>
            <br>
            </div>
        </div>
    </div>
</div>



<?php
mysqli_close($connection);
include __DIR__ . "/footer.php";
?>

