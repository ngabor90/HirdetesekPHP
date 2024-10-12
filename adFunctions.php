<?php

function checkItemPost()
{
    if (isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["category"]) && isset($_POST["price"])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $category = $_POST["category"];
        $price = $_POST["price"];
        $userhash = $_COOKIE["currentUser"];

        $conn = dbInit();

        $guid = getGuid();

        $sql = "INSERT INTO ads (id, name, description, category, price, ownerId) 
                VALUES ('" . $guid . "', '" . $name . "', '" . $description . "', '" . $category . "', '" . $price . "', '" . $userhash . "')";

        if ($conn->query($sql) === TRUE) {
            echo '<p class="success text-center py-3">A termék sikeresen feltöltésre került!</p>';
        } else {
            echo '<p class="error">Adatbázis hiba: ' . $conn->error . '</p>';
        }
        $conn->close();
        /*header("Location: /ads.php");
        exit();*/
    }
}

function getCategories()
{
    $sql = "SELECT DISTINCT category FROM ads ORDER BY category ASC;";
    $conn = dbInit();
    $result = $conn->query($sql);
    $categories = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($categories, $row["category"]);
        }
    } else {
        echo "<p>Nincsenek elérhető hirdetések.</p>";
    }

    $conn->close();
    return $categories;
}

function printCategorySelector()
{
    $categories = getCategories();

    echo '<form class="mb-3" method="GET" action="ads.php">';
    echo '<div class="container my-4">';  

    echo '<div class="row">';  
    echo '<div class="col-12">';  
    echo '<select id="categories" name="categories" class="form-select">';  
    echo '<option value="ALL" selected>Mindegyik</option>';
    for ($i = 0; $i < count($categories); $i++) {
        echo '<option value="' . htmlspecialchars($categories[$i]) . '">' . htmlspecialchars($categories[$i]) . '</option>';
    }
    echo '</select>';
    echo '</div>'; 

    echo '<div class="col-12">';  
    echo '<button class="btn btn-primary mt-4" type="submit">Szűrés</button>';  
    echo '</div>';  
    echo '</div>'; 

    echo '</div>';  
    echo '</form>';
}

function adCheckFilter(){
    if(isset($_GET["categories"])){
        $category = $_GET["categories"];
        if($category == "ALL"){
            listAds();
        }
        else{
            listAdsParams($category);
        }
    }
}

function listAds()
{
    $conn = dbInit();

    // SQL lekérdezés, INNER JOIN a felhasználói adatokkal
    $sql = "SELECT ads.id, ads.name, ads.description, ads.price, ads.category, users.email, users.firstName, users.lastName
            FROM ads
            INNER JOIN users ON ads.ownerId = users.id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Reszponzív táblázat megjelenítése
        echo "<div class='table-responsive'>"; // Reszponzív táblázat körül egy div
        echo "<table class='table table-striped table-hover'><tr><th>Termék neve</th><th>Termék leírása</th><th>Termék ára</th><th>Eladó neve</th><th>Eladó email címe</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";  // htmlspecialchars használata XSS ellen
            echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["lastName"]) . " " . htmlspecialchars($row["firstName"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>"; // Reszponzív táblázat div vége
    } else {
        // Nincs találat
        echo "<p>Nincsenek elérhető hirdetések.</p>";
    }

    // Kapcsolat bezárása
    $conn->close();
}


function listAdsParams($category)
{
    $conn = dbInit();

    // SQL lekérdezés, INNER JOIN a felhasználói adatokkal
    $sql = "SELECT ads.id, ads.name, ads.description, ads.price, ads.category, users.email, users.firstName, users.lastName
            FROM ads
            INNER JOIN users ON ads.ownerId = users.id
            WHERE ads.category='".$category."';";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Reszponzív táblázat megjelenítése
        echo "<div class='table-responsive'>"; // Reszponzív táblázat körül egy div
        echo "<table class='table table-striped table-hover'><tr><th>Termék neve</th><th>Termék leírása</th><th>Termék ára</th><th>Eladó neve</th><th>Eladó email címe</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";  // htmlspecialchars használata XSS ellen
            echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["lastName"]) . " " . htmlspecialchars($row["firstName"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>"; // Reszponzív táblázat div vége
    } else {
        // Nincs találat
        echo "<p>Nincsenek elérhető hirdetések.</p>";
    }

    // Kapcsolat bezárása
    $conn->close();
}

