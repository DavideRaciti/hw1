<?php 
    require_once 'authentication.php';

    // Se la sessione è scaduta, esco
    if (!checkAuth()) exit;

    // Imposto l'header della risposta
    header('Content-Type: application/json');


    car_make();

    function car_make() {
        $query = urlencode($_GET["q"]);
        $API_KEY = "X-Api-Key: A7pwKpz6vd21hp/QqLtgWQ==5RqUbo0IINodM889";
        $url = "https://api.api-ninjas.com/v1/cars?limit=1&model=".$query;
    
        $conn = curl_init($url);

        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($conn, CURLOPT_HTTPHEADER, [$API_KEY]);
    
        $result = curl_exec($conn);

        curl_close($conn);
    
        echo $result;
    }
?>