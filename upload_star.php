<?php
    require_once 'authentication.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    } 

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $user = mysqli_real_escape_string($conn, $userid);
    $circuitid = mysqli_real_escape_string($conn, $_POST["circuitid"]);

    $query = "SELECT * FROM stars WHERE user = '$user' AND circuit = '$circuitid'";

    $res = mysqli_query($conn, $query) or die(mysqli_connect_error());

    if(mysqli_num_rows($res) > 0){
        echo json_encode(array('full' => true));
        mysqli_close($conn);
        exit;
    }

    mysqli_close($conn);
    echo json_encode(array('full' => false));

?>