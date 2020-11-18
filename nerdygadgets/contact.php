<?php
include __DIR__ . "/header.php";
?>

<div class="IndexStyle">
    <div class="col-11">
        <div class="TextMain">
            <div class="TextPrice">
            telefoonnummer:
            <?php

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
                print($contact["phone"] );
            }
            mysqli_close($connection);


            ?>
            <br>
            email:
            <?php

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
                print($contact["email"] );
            }
            mysqli_close($connection);

            ?>


            <br>
            addres:

            <?php

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
                print($contact["address"] );
            }
            mysqli_close($connection);

            ?>


            <br>
            </div>
        </div>
    </div>
</div>



<?php
include __DIR__ . "/footer.php";
?>

