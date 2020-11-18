<?php
include __DIR__ . "/header.php";
?>
<div class="IndexStyle">
    <div class="col-11">
    <table class="table table-striped" style="color: white !important;">
    <thead>
    <tr>
      <th scope="col">product</th>
      <th scope="col">levertijd</th>
     
    </tr>
  </thead>
  <tbody>

  

        <?php
        if (!empty($_SESSION["shopping_cart"])) {
            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                echo "
                <tr>
                <td>".$values['item_name']."</td>
                <td>".rand(1,7)." dagen</td>
              </tr> ";
            }
        }
        ?>
  </tbody>
</table>
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Adres + huisnummer</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Adres">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Postcode</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="1234AB">
            </div>
            <br />


            <label for="form-grou[">
                Selecteer de verzendmethode
                <select class="form-control">
                    <option>Thuis bezorgen</option>
                    <option>Afhaalpunt</option>
                </select>
            </label>


            <br />
            <br />

            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" style="width: auto; height: auto;">
                    <img src="public/img/postnl.png" alt="" style="width: 150px; margin-left: 50px; cursor: pointer;">
                    <span>
                        €7,95 Verzendkosten.

                    </span>
                    <span>
                        1 tot 3 dagen levertijd

                    </span>


                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" style="width: auto; height: auto;">
                    <img src="public/img/dhl.png" alt="" style="width: 200px; margin-left: 20px; cursor: pointer;">
                    €4,95 Verzendkosten.
                    3 tot 5 dagen levertijd

                </label>
            </div>


        </form>


        <a href="ideal.php">
            <h2>Klik hier om te betalen met ideal</h2>

            <img src="public/Img/ideal.png" alt="" style="width: 300px;">
        </a>

    </div>
</div>
<?php
include __DIR__ . "/footer.php";
?>