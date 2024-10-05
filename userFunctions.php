<?php

require 'db.php';


function checkUserPass($email, $password, $conn)
{
    $user = '';
    $hash = hash('sha256', $password);
    $sql = "SELECT * FROM users WHERE email='" . $email . "' AND password='" . $hash . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user = array($row["id"], $row["firstName"], $row["lastName"]);
        }
    } else {
        return false;
    }
    $conn->close();
    return $user[0];
}

function getUserInfo($id)
{
    $conn = dbInit();
    $user = '';
    $sql = "SELECT * FROM users WHERE id='" . $id . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user = array($row["id"], $row["firstName"], $row["lastName"], $row["email"]);
        }
    } else {
        die('db error');
    }
    $conn->close();
    return $user;
}


function checkLogin()
{
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $conn = dbInit();
        $succ = checkUserPass($email, $password, $conn);
        if ($succ != false) {
            setcookie("currentUser", $succ, time() + (86400 * 30), "/");
            header("Location: /hirdetesek/login.php");
            exit();
        } else {
            echo '<p class="error">Helytelen jelszó vagy email!</p>';
        }
    }
}

function loginForm()
{
    echo '<div class="container my-4">
    <div class="row">
        <div class="col-12">
    <form action="login.php" method="post">
    <label class="form-label" for="email">Email</label>
    <input class="form-control" type="email" name="email">

    <label class="form-label" for="password">Jelszó</label>
    <input class="form-control" type="password" name="password">

    <input class="btn btn-primary my-4" type="submit" value="Bejelentkezés">

    <br>
    <a href="register.php">Új regisztráció létrehozása</a>
</form>
        </div>
    </div>
</div>';
}

function profileForm()
{
    $userData = getUserInfo($_COOKIE["currentUser"]);
    echo '
    <div class="container my-4">
    <div class="row">
        <div class="col-12">
    <form action="profile.php" method="post">
    <label class="form-label" for="email">Email</label>
    <input class="form-control" type="email" name="email" value="' . $userData[3] . '">

    <label class="form-label" for="lastName">Vezetéknév</label>
    <input class="form-control" type="text" name="lastName" value="' . $userData[1] . '">

    <label class="form-label" for="firstName">Keresztnév</label>
    <input class="form-control" type="text" name="firstName" value="' . $userData[2] . '">

    <input class="btn btn-dark my-4" type="submit" value="Profil módosítása">

</form>
        </div>
    </div>
</div>
    ';
}

function checkUserMod()
{
    // Ellenőrizd, hogy minden POST adat be van állítva
    if (isset($_POST["email"]) && isset($_POST["firstName"]) && isset($_POST["lastName"])) {
        $conn = dbInit(); // Adatbázis kapcsolat inicializálása
        $id = $_COOKIE["currentUser"];
        $email = $_POST["email"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];

        // SQL lekérdezés összeállítása
        $sql = "UPDATE users SET firstName = '" . $firstName . "', lastName = '" . $lastName . "', email='" . $email . "' WHERE id = '" . $id . "';";

        // A lekérdezés végrehajtása
        if ($conn->query($sql) === TRUE) {
            // Sikeres frissítés esetén átirányítás
            header("Location: /hirdetesek/login.php");
            exit();
        } else {
            // Hiba esetén hibaüzenet kiírása
            echo '<p class="error">Adatbázis hiba: ' . $conn->error . '</p>';
        }

        // Kapcsolat bezárása
        $conn->close();
    } else {
        echo '
        <div class="container my-4">
        <div class="row">
        <div class="col-12">
        <h3>A profil módosításához kérjük, töltse ki az összes mezőt!</h3>
        </div>
    </div>
</div>
        ';
    }
}


function isLoggedIn()
{
    if (isset($_COOKIE["currentUser"])) {
        return true;
    } else {
        return false;
    }
}

function checkRegister()
{
    if (
        isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password2"])
        && isset($_POST["firstName"]) && isset($_POST["lastName"])
    ) {

        $email = $_POST["email"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];

        // Jelszó egyezésének ellenőrzése
        if ($password != $password2) {
            echo '<p class="error">Nem egyezik a jelszó!</p>';
            return;  // Kilépés, ha a jelszavak nem egyeznek
        }

        // Adatbázis kapcsolat inicializálása
        $conn = dbInit();
        $hash = hash('sha256', $password); // Jelszó hashelése
        $guid = getGuid(); // GUID generálása

        // SQL beszúrás
        $sql = "INSERT INTO users (id, email, password, firstName, lastName) 
                VALUES ('" . $guid . "', '" . $email . "', '" . $hash . "', '" . $firstName . "', '" . $lastName . "')";

        // Lekérdezés futtatása
        if ($conn->query($sql) === TRUE) {
            setcookie("currentUser", $guid, time() + (86400 * 30), "/"); // 30 napig érvényes cookie beállítása
            header("Location: /hirdetesek/login.php"); // Továbbirányítás a bejelentkezés oldalra
            exit();  // Fontos az exit használata a header után
        } else {
            echo '<p class="error">Adatbázis hiba: ' . $conn->error . '</p>';
        }

        // Kapcsolat bezárása
        $conn->close();
    }
}


function getGuid()
{
    if (function_exists('com_create_guid')) {
        return trim(com_create_guid(), '{}');
    } else {
        mt_srand((double) microtime() * 10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45); // "-"
        $uuid = substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);
        return $uuid;
    }
}


function logOut()
{
    setcookie("currentUser", "", time() - 100, "/");
}