<?php

require 'template.php';
require 'userFunctions.php';

checkLogin();
headerLoad();

if(isset($_COOKIE["currentUser"])){
    $id = $_COOKIE["currentUser"];
    $conn = dbInit();
    $userData = getUserInfo($id);
    echo '
    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <h1>Üdv, ' . htmlspecialchars($userData[2]) . ' ' . htmlspecialchars($userData[1]) . '!</h1>
                <a href="logout.php" class="btn btn-danger mt-2">Kijelentkezés</a>
            </div>
        </div>
    </div>';
} else {
    loginForm();
}
?>

<?php
footerLoad();
?>