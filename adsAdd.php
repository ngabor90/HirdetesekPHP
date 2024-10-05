<?php

require 'template.php';
require 'userFunctions.php';
require 'adFunctions.php';
headerLoad();
if(isLoggedIn() == false){
    header("Location: /hirdetesek/login.php");
    exit();
}
checkItemPost();
?>
<div class="container my-4">
    <div class="row">
        <div class="col-12">
        <form action="adsAdd.php" method="post">
    <label class="form-label" for="name">Termék név</label>
    <input class="form-control" type="text" name="name" required>

    <label class="form-label" for="description">Termék leírás</label>
    <input class="form-control" type="text" name="description" required>

    <label class="form-label" for="category">Kategória</label>
    <input class="form-control" type="text" name="category" required>

    <label class="form-label" for="price">Ár</label>
    <input class="form-control" type="number" name="price" required>

    <input class="btn btn-dark my-4" type="submit" value="Feltöltés">
</form>

        </div>
    </div>
</div>

<?php
footerLoad();
?>