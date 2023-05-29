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
      $res = mysqli_query($conn, $query);
      $user = mysqli_fetch_assoc($res); 
    ?>

  <head>
    <link rel='stylesheet' href='profilo.css'>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
    <script src="profile.js" defer="true"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <title>AutoGear</title>
  </head>

  <body>  
    <nav id='barra'>
      <div id="logo">
        AutoGear | <?php echo $user['name'] . " " . $user['surname']; ?>
      </div>
      <div id="links">
        <a href='circuiti.php'>Circuiti</a>
        <a href='home.php'>Torna alla Home</a>
        <div id="separator"></div>
        <a href='logout.php' class='button'>LOGOUT</a>
      </div>

      <div id="menu">
          <div></div>
          <div></div>
          <div></div>
      </div>
    </nav>
      
    <header>
      <h1> <?php echo $user['username']; ?>, ecco i tuoi circuiti preferiti:</h1>
    </header>
    
    <section id='circuiti'>

      <div class='title'>
        <div class='circuits'>
          <h3>Nessun circuito preferito</h3>
        </div>
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

<?php mysqli_close($conn); ?>