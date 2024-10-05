<?php

require 'template.php';
require 'db.php';   
require 'adFunctions.php';
headerLoad();
echo '
<div class="container my-4">
    <div class="row">
        <div class="col-12">
            <h4>Hirdetések</h4>
        </div>
    </div>
</div>';
printCategorySelector();
adCheckFilter();

footerLoad();