<?php

require 'template.php';
require 'userFunctions.php';
headerLoad();
if(isLoggedIn() == false){
    header("Location: /hirdetesek/login.php");
    exit();
}
checkUserMod();
profileForm();

footerLoad();