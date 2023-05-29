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
    <link rel="stylesheet" href="circuiti.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="circuiti.js" defer="true"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  </head>
  
  <body>
    <header>
      <nav id='barra'>
        <div id="logo">
          AutoGear | Circuiti
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
      <div id='txt'>
        <h1>Ti piace gareggiare in pista o guardare le gare dal vivo?</h1>
        <a class="subtitle">
          Scopri di più sui circuiti automobilistici più belli e famosi al mondo!
        </a>
      </div>
    </header>

    <main>
      <section id='circuiti'>

        <div class='title'>
          <div>
            <h2 class='type selected' data-type="automobilistici">Circuiti automobilistici</h2>
            <h2 class='type' data-type="formula1">Formula 1</h2>
          </div>
        </div>

        <div class='circuits-div'>

        </div>

      </section>
    </main>

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

<?php mysqli_close($conn); ?>