<?php
    require_once 'authentication.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    } 

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $user = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT c.id as id, c.name as name, c.type as type, c.picture as picture FROM circuits c JOIN stars s on c.id = s.circuit WHERE s.user = '$user'";

    $res = mysqli_query($conn, $query) or die(mysqli_connect_error());

    $jsonArray = array();
    while($row = mysqli_fetch_assoc($res)){
        $jsonArray[] = array('id' => $row['id'], 'name' => $row['name'],
        'type' => $row['type'], 'picture' => $row['picture']);
    }

    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($jsonArray);

    exit;
?>