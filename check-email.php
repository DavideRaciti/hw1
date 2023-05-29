<?php
    require_once 'db-config.php';

    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    header('Content-Type: application/json');
    
    //connessione al database
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    //leggo la stringa dell'email
    $email = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT email FROM users WHERE email = '$email'";

    $res = mysqli_query($conn, $query) or die(mysqli_connect_error());

    // Torna un JSON con chiave exists e valore boolean
    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_close($conn);
?>