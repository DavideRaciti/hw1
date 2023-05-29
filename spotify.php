<?php 
    require_once 'authentication.php';

    // Se la sessione è scaduta, esco
    if (!checkAuth()) exit;

    // Imposto l'header della risposta
    header('Content-Type: application/json');


    spotify();

    function spotify() {
        $client_id = '0e59997f5ebf4d9ebe86c7b10cc00e8f';
        $client_secret = '2f3ded3295294be9991ef348384d308b'; 

        // TOKEN
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token' );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # Eseguo la POST
        curl_setopt($ch, CURLOPT_POST, 1);
        # Setto body e header della POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
        $token=json_decode(curl_exec($ch), true);
        curl_close($ch);    

        // QUERY 
        $query = urlencode($_GET["q"]);
        $url = 'https://api.spotify.com/v1/search?type=playlist&q='.$query;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # Imposto il token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
        $res=curl_exec($ch);

        curl_close($ch);

        echo $res;
    }
?>