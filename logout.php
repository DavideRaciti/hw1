<?php
    include 'db-config.php';

    // Distruggo la sessione esistente
    session_start();
    session_destroy();

    header('Location: login.php');
?>