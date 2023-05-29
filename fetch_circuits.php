<?php
    require_once 'authentication.php';
    
    // Se la sessione è scaduta, esco
    if (!checkAuth()) exit;

    require_once 'db-config.php';

    //Header della risposta
    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $type = mysqli_real_escape_string($conn, $_GET['type']);
    $query = "SELECT * FROM circuits WHERE type = '$type' LIMIT 9";

    $res = mysqli_query($conn, $query) or die(mysqli_connect_error());

    $jsonArray = array();
    while($row = mysqli_fetch_assoc($res)){
        $jsonArray[] = array('id' => $row['id'], 'name' => $row['name'], 'lenght' => $row['lenght'],
        'picture' => $row['picture'], 'user' => $row['user']);
    }

    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($jsonArray);

    exit;
?>