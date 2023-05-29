<?php 
    require_once 'authentication.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
  <?php 
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);   
  ?>

  <head>
    <title>AutoGear</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="homee.js" defer="true"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  </head>
  
  <body>
    <nav id='barra'>
      <div id="logo">
        AutoGear
      </div>
    
      <div id="links">
        <a href='home.php'>Home</a>
        <a href='spotify_api.php'>Spotify</a>
        <a href='circuiti.php'>Circuiti</a>
        <div id="separator"></div>
        <a href='profile.php'>Profilo</a>
        <a href='logout.php' class='button'>LOGOUT</a>
      </div>

      <div id="menu">
          <div></div>
          <div></div>
          <div></div>
      </div>
    </nav>

    <header>
      <h1>AutoGear: Esplora la passione per le auto con noi!</h1>
      <a class="subtitle">
        Con AutoGear scopri di più sulle tue auto preferite, circuiti da percorrere e musica da ascoltare!
      </a>
    </header>

    <h2 class='txt'>Cerca qui le auto tramite il loro modello o marchio e scopri di più sulle loro caratteristiche!</h2>

    <section id="search">
      <form autocomplete="off">
        <div class="search">
          <label for='search'>Cerca</label>
          <input type='text' name="search" class="searchBar">
          <div class='box'>
            <select name = 'tipo' id='tipo'>
                  <option value='marchio'>Marchio</option>
                  <option value='modello'>Modello</option>
            </select>
          </div>
          <input type="submit" value="Cerca">
        </div>
      </form>
    </section>

    <section class="container">
            <div id="results">
                
            </div>
    </section>

    <footer class="footer">
      <div class="social-icon">
        <div class="social-icon__item"><a class="social-icon__link" href="#">
            <ion-icon name="logo-facebook"></ion-icon>
          </a></div>
        <div class="social-icon__item"><a class="social-icon__link" href="#">
            <ion-icon name="logo-twitter"></ion-icon>
          </a></div>
        <div class="social-icon__item"><a class="social-icon__link" href="#">
            <ion-icon name="logo-linkedin"></ion-icon>
          </a></div>
        <div class="social-icon__item"><a class="social-icon__link" href="#">
            <ion-icon name="logo-instagram"></ion-icon>
          </a></div>
      </div>
      <div class="menu">
        <div class="menu__item"><a class="menu__link" href="home.php">Home</a></div>
        <div class="menu__item"><a class="menu__link" href="#">About</a></div>
        <div class="menu__item"><a class="menu__link" href="#">Services</a></div>
        <div class="menu__item"><a class="menu__link" href="#">Team</a></div>
        <div class="menu__item"><a class="menu__link" href="#">Contact</a></div>
      </div>
    <em>Davide Raciti - 1000016306</em>
    </footer>
  </body>
</html>