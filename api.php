<?php
    require_once 'database_config.php';
    session_start();

    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

if($_GET['type'] === 'image'){
    image();
    return;
}   
else{
    giphy();
    return;
}
function image(){
    
    $maxResults = 16;
    $img_endpoint = 'https://pixabay.com/api/' ;
    $img_key = '27098682-177d8dd4c1f1e14ce9427da09';
    $q = urlencode($_GET['q']);
    $url = $img_endpoint.'?key='.$img_key.'&q='.$q.'&per_page='.$maxResults;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    
    echo $result;
}


function giphy() {
    
    $maxResults = 16;
    $giphy_endpoint = 'api.giphy.com/v1/stickers/search' ;
    $giphy_key = 'pYky72JMkWYoFawDi5mDfItKqjT9dCKH';
    $q = urlencode($_GET['q']);
    $url = $giphy_endpoint.'?q='.$q.'&api_key='.$giphy_key.'&limit='.$maxResults;
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    
    echo $result;
}
?>