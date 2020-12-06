<?php require __DIR__ . "/header.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        div.middle {
            position: relative;
            margin: 0 auto;
            top: 100px;
        }

        div.login {
            text-align: center;
            font-size: x-large;
        }

        div.left {
            text-align: center;
        }

        input.small {
            width: 20px;
            height: 20px;
        }

        input[type=text], input[type=email] {
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
            width: 20%;
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
                <input required id="firstname" type="text" placeholder="Voornaam" name="firstname"><br>
                <input required id="username" type="text" placeholder="Gebruikersnaam*" name="username"><br>
                <input required id="password" type="password" placeholder="Wachtwoord" name="password"><br>
                <input required id="phonenumber" type="text" placeholder="Telefoonnummer" name="phonenumber"><br>
                <input required id="faxnumber" type="text" placeholder="Faxnummer" name="faxnumber"><br>
                <input required id="emailaddress" type="email" placeholder="voorbeeld@voorbeeld.com" name="emailaddress"><br>
                <br>
                <h2>Adres gegevens</h2>
                <input required id="street" type="text" placeholder="Straatnaam" name="street"><br>
                <input required id="housenumber" type="text" placeholder="Huisnummer" name="housenumber"><br>
                <input required id="postalcode" type="text" placeholder="" name="postalcode"><br>
                <input required id="postalcode" type="text" placeholder="" name="postalcode"><br>

                <div class="left">
                    <input type="checkbox" class="small" onclick="myFunction()"> Wachtwoord tonen<br><br>
                </div>

                <br>
                <input type="submit" value="Registreer">
            </div>
        </div>
        <script>
            function myFunction() {
                var x = document.getElementById("password");
                if (x.type === "text") {
                    x.type = "password";
                } else {
                    x.type = "text";
                }
            }
        </script>
    </form>
    <br><br><br>
    <?php
    if (!empty($_POST["fullname"])) {
        $fullname = $_POST["fullname"];
        $firstname = $_POST["firstname"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $phonenumber = $_POST["phonenumber"];
        $faxnumber = $_POST["faxnumber"];
        $emailaddress = $_POST["emailaddress"];
        $extra = $_POST["fullname"];

        $number = 1;
        $issalesperson = 0;
        $ispermittedtologon = 1;
        $isemployee = 0;
        $issytemuser = 1;
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
        $zero = 0;


        $query = "INSERT INTO people (FullName, PreferredName, SearchName, LogonName, HashedPassword, PhoneNumber, FaxNumber, EmailAddress, LastEditedBy, IsSalesPerson, IsEmployee, IsPermittedToLogon, IsSystemUser , IsExternalLogonProvider)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $Statement = mysqli_prepare($Connection, $query);
        mysqli_stmt_bind_param($Statement,"ssssssssiiiiii", $fullname, $fullname, $fullname, $username, $hashedpassword, $phonenumber, $faxnumber, $emailaddress,$number,  $issalesperson, $isemployee, $ispermittedtologon, $issytemuser, $zero);
        mysqli_stmt_execute($Statement);

        $select = "SELECT PersonID FROM people WHERE FullName = ?";
        $selectstmt = mysqli_prepare($Connection, $select);
        mysqli_stmt_bind_param($selectstmt, "s", $fullname, );
        mysqli_stmt_execute($selectstmt);

        $SelectResult = mysqli_stmt_get_result($Statement);
        $SelectResult = mysqli_fetch_all($SelectResult, MYSQLI_ASSOC);
        $selectarray = $SelectResult[0];
        $userID = $selectarray["PersonID"];

        $Query = "INSERT INTO customers (CustomerName, BillToCustomerID, CustomeraCategoryID, BuyingGroupID, PrimaryContactPersonID, AlternateContactPersonID, DeliveryMethodID, DeliveryCityID, PostalCityID, CreditLimit, AccountOpendDate, StandardDiscountPercentage, IsStatementSent, IsOnCreditHold, PaymentDays, PhoneNumber, DeliveryAddressLine1, DeliveryPostalCode, )";

        $stmt = mysqli_prepare($Connection, $Query);
        mysqli_stmt_bind_param($stmt, "sssss", $fullname, );
        echo '<script>alert("Succesvol geregistreerd je wordt met 5 seconden doorverwezen naar de login pagina")</script>';
        sleep(5);
        echo '<script>window.location="login.php"</script>';
    }



    ?>
</fieldset>
</body>
</html>

