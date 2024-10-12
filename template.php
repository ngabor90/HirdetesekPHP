<?php

function headerLoad()
{
    $loginText = "Bejelentkezés";
    $loginRoute = "login.php";
    if (isset($_COOKIE["currentUser"])) {
        $loginText = "Kijelentkezés";
        $loginRoute = "logout.php";
    }

    echo '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apróhirdetések</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container my-4">
    <a class="navbar-brand" href="index.php">Apróhirdetések</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link mx-3" aria-current="page" href="ads.php">Hirdetések</a>
        </li>';

        if (isset($_COOKIE["currentUser"])) {
            echo '<li class="nav-item">
                  <a class="nav-link mx-3" href="adsAdd.php">Hirdetés feladása</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mx-3" href="profile.php">Profilom</a>
                </li>';
        }
    
        // Hozzáadjuk a bejelentkezési/kijelentkezési gombot
        echo '</ul>
              <div class="d-flex justify-content-center mt-2 mt-lg-0">
                <a href="' . $loginRoute . '" class="mx-4 btn btn-secondary">' . $loginText . '</a>
              </div>
            </div>
          </div>
        </nav>
    
        <div id="content">
        ';
}

function footerLoad()
{
    echo '</div>

    <footer id="footer" class="text-center bg-dark text-white">
        <h4>Copyright Németh Gábor</h4>
    </footer>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>';
}
