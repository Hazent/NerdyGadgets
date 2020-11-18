<?php require __DIR__ . "/header.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        div.middle {
            position: relative;
            left: 650px;
            top: 100px;
        }

        div.login {
            float: left;
            text-align: center;
            font-size: x-large;
        }

        div.left {

            text-align: left;
        }

        input.small {
            width: 20px;
            height: 20px;
        }

        input[type=text] {
            position: center;
            color: #000000;
            font-size: x-large;
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            max-width: 572.578px;
            padding: 5px;
        }

        input[type=password] {
            position: center;
            color: #000000;
            font-size: x-large;
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            max-width: 572.578px;
            padding: 5px;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 0px 10px;
            margin: 8px 0;
            border-radius: 4px;
        }

        input[type=submit]:hover {
            background-color: #397a3f;
        }

    </style>
</head>
<body>
<fieldset>
    <form method="post" action="register.php">
        <div class="middle">
            <div class="left"><h1><strong>Registreer</strong></h1></div>
            <br> <br> <br>
            <div class="login">
                <input required id="fullname" type="text" placeholder="Volledige naam" name="fullname"> <br>
                <input required id="firstname" type="text" placeholder="voornaam" name="firstname"><br>
                <input required id="username" type="text" placeholder="Gebruikersnaam*" name="username"><br>
                <input required id="password" type="text" placeholder="wachtwoord" name="password"><br>
                <input required id="phonenumber" type="text" placeholder="telefoonnummer" name="phonenumber"><br>
                <input required id="faxnumber" type="text" placeholder="faxnummer" name="faxnumber"><br>
                <input required id="emailaddress" type="text" placeholder="voorbeeld@voorbeeld.com" name="emailaddress"><br>
                <div class="left">
                    <input type="checkbox" class="small" onclick="myFunction()"> Wachtwoord tonen<br><br>
                </div>

                <br>
                <input type="submit" value="registreer">
            </div>
        </div>
        <script>
            function myFunction() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
    </form>
    <?php
    if (!empty($_POST["fullname"])) {
        $fullname = $_POST["fullname"];
        $firstname = $_POST["firstname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $phonenumber = $_POST["phonenumber"];
        $faxnumber = $_POST["faxnumber"];
        $emailaddress = $_POST["emailaddress"];
        $number = 1;
        $issalesperson = 0;
        $ispermittedtologon = 1;
        $isemployee = 0;
        $issytemuser = 1;
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO people (FullName, PreferredName, LogonName, HashedPassword, PhoneNumber, FaxNumber, EmailAddress, LastEditedBy, IsSalesPerson, IsEmployee, IsPermittedToLogon, IsSystemUser )
values (?,?,?,?,?,?,?,?,?,?,?,?)";

        $Statement = mysqli_prepare($Connection, $query);
        mysqli_stmt_bind_param($Statement, "ssssiisiiiii", $fullname, $firstname, $username, $password, $phonenumber, $faxnumber, $emailaddress, $number, $issalesperson, $isemployee, $ispermittedtologon, $issytemuser);
        mysqli_stmt_execute($Statement);
        echo '<script>alert("succesvol geregistreerd je wordt met 5 seconden doorverwezen naar de login pagina")</script>';
        sleep(5);
        echo '<script>window.location="login.php"</script>';
    }



    ?>
</fieldset>
</body>
</html>
