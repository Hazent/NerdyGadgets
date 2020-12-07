<title>Nerdygadgets - Inloggen</title>

<?php include __DIR__ . "/header.php";?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        div.middle {
            position: relative;
            left: 35%;
            right: 35%;
            top: 100px;
        }
        div.login {
            float: left;
            text-align: center;
            font-size: x-large;
        }
        div.left {
            float: left;
            text-align: left;
        }
        input.small {
            width: 20px;
            height: 20px;
        }
        input[type=text], input[type=password]{
            position: relative;
            width: 100%;
            color: #000000;
        }
        input[type=submit] {
            width: 80%;
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
    <form method="post" action="login.php">
        <div class="middle">
            <div class="left"> <h1><strong>Inloggen</strong></h1> </div> <br> <br> <br>
            <div class="login">
                <p>
                    <input type="text" placeholder="Gebruikersnaam*" class="text" name="naam" required>
                    <input type="password" placeholder="Wachtwoord*" class="text" name="wachtwoord" id="myInput" required>

                <div class="left">
                    <input type="checkbox" class="small" onclick="myFunction()"> Wachtwoord tonen<br><br>
                </div>
                <br>
                <input type="submit" value="Inloggen"><br>
                </p>
                Nog geen account? <a href=register.php>Registreer</a> <br>
                </p>
            </div>
        </div>
        <script>
            function myFunction() {
                var x = document.getElementById("myInput");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
    </form>
    <?php
    if (!empty($_POST["wachtwoord"]) && !empty($_POST["naam"])) {
        $wachtwoord = $_POST["wachtwoord"];
        $naam = $_POST["naam"];


        $Query = "
        SELECT PersonID, LogonName, Hashedpassword
        FROM people
        WHERE LogonName = ?";

#connection
        $Statement = mysqli_prepare($Connection, $Query);
        mysqli_stmt_bind_param($Statement, 's', $naam);
        mysqli_stmt_execute($Statement);
        $Result = mysqli_stmt_get_result($Statement);
        $Result = mysqli_fetch_all($Result, MYSQLI_ASSOC);


        $array = $Result["0"];
        $Hashedpassword = $array["Hashedpassword"];
        if(password_verify($wachtwoord, $Hashedpassword)) {
            echo '<script>alert("Succesvol ingelogd je wordt met 5 seconden doorverwezen naar de winkel pagina")</script>';
            $_SESSION['personId'] = $array["PersonID"];
            sleep(5);
            echo '<script>window.location="index.php"</script>';
        } else {
            echo '<script>alert("Wachtwoord en gebruikersnaam komen niet overeen")</script>';
        }
    }
    ?>
</body>
</html>