<?php

require 'template.php';
require 'userFunctions.php';
logOut();
header("Location: /login.php");
exit();