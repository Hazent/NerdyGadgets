<?php
include __DIR__ . "/header.php";
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        setTimeout(() => { $("#myModal").modal('show'); }, 5000);
    });
</script>
<div class="IndexStyle">
    <div class="col-11">
        <div class="TextPrice">
            <a href="view.php?id=93">
                <div class="TextMain">
                    "The Gu" red shirt XML tag t-shirt (Black) M
                </div>
                <ul id="ul-class-price">
                    <li class="HomePagePrice">€30.95</li>
                </ul>
        </div>
        </a>
        <div class="HomePageStockItemPicture"></div>
    </div>
</div>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: #000000;">Registreer voor 25% KORTING</h4>
            </div>
            <div class="modal-body" style="color: #000000;">
                <strong><a href="register.php"> Klik hier om te registreren!</a></strong>
            </div>
        </div>
    </div>
</div>
<?php
include __DIR__ . "/footer.php";
?>

