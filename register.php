<?php

require 'template.php';
require 'userFunctions.php';

headerLoad();
checkRegister();

?>
<div class="container my-4">
    <div class="row">
        <div class="col-12">
            <form id="loginMenu" action="register.php" method="post">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" name="email" required>

                <label class="form-label" for="password">Jelszó</label>
                <input class="form-control" type="password" name="password" required>

                <label class="form-label" for="password">Jelszó ismét</label>
                <input class="form-control" type="password" name="password2" required>

                <label class="form-label" for="email">Keresztnév</label>
                <input class="form-control" type="text" name="firstName" required>

                <label class="form-label" for="email">Vezetéknév</label>
                <input class="form-control" type="text" name="lastName" required>

                <input type="submit" class="btn btn-primary my-4" value="Regisztráció">

            </form>
        </div>
    </div>
</div>

<?php
footerLoad();
?>