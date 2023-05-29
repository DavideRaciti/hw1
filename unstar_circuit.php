<?php
    require_once 'authentication.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    } 

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $circuitid = mysqli_real_escape_string($conn, $_POST["circuitid"]);

    $query = "DELETE FROM stars WHERE user = '$userid' AND circuit = '$circuitid'";

    $res = mysqli_query($conn, $query) or die(mysqli_connect_error());

    if($res){
        echo json_encode(array('remove' => true));
        mysqli_close($conn);
        exit;
    }

    mysqli_close($conn);
    echo json_encode(array('remove' => false));

?>