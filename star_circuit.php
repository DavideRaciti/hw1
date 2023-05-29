<?php
    require_once 'authentication.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    } 

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $user = mysqli_real_escape_string($conn, $userid);
    $circuitid = mysqli_real_escape_string($conn, $_POST["circuitid"]);

    $query = "INSERT INTO stars(user, circuit) VALUES($user, $circuitid)";

    $res = mysqli_query($conn, $query) or die(mysqli_connect_error());

    if($res){
        echo json_encode(array('add' => true));
        mysqli_close($conn);
        exit;
    }

    mysqli_close($conn);
    echo json_encode(array('add' => false));

?>