<?php

require 'template.php';
require 'userFunctions.php';
headerLoad();
if(isLoggedIn() == false){
    header("Location: /login.php");
    exit();
}
checkUserMod();
profileForm();

footerLoad();