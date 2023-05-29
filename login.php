<?php
    // Verifica che l'utente sia già loggato, se è così allo va direttamente alla home
    include 'authentication.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_connect_error());
        
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        $query = "SELECT id, username, password FROM users WHERE username = '$username'";
                                                                                                            
        $res = mysqli_query($conn, $query) or die(mysqli_connect_error());;
        if (mysqli_num_rows($res) > 0) {
            
            $row = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $row['password'])) {
                $_SESSION["session_username"] = $row['username'];
                $_SESSION["session_user_id"] = $row['id'];
                header("Location: home.php");
                mysqli_close($conn);
                exit;
            }
        }
        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        $error = "Inserisci username e password.";
    }
?>

<html>
    <head>
        <link rel='stylesheet' href='sign_up.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
        <title>AutoGear - Login</title>
    </head>

    <body>
        <main class="login">

        <section>
            <h1>Bentornato su AutoGear!</h1>
            <h3>Accedi al tuo profilo</h3>
            <?php
                if (isset($error)) {
                    echo "<span class='error'>$error</span>";
                }
            ?>

            <form name='login' method='post'>
                <div class="username">
                    <div><label for='username'>Username</label></div>
                    <div><input type='text' name='username'></div>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password'></div>
                </div>
                <div>
                    <input type='submit' value="ACCEDI">
                </div>
            </form>
            <div class="signin">Non hai un account? <a href="sign-up.php">Iscriviti</a>
        </section>
        
        </main>
    </body>
</html>