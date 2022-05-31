<?php

require_once 'database_config.php';
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


$connection = mysqli_connect($dbconf['host'], $dbconf['user'], $dbconf['password'], $dbconf['name']) or die(mysqli_error($connection));
$username = mysqli_real_escape_string($connection, $_SESSION['username']);
$query = "SELECT * FROM posts JOIN users ON posts.user = users.id  ORDER BY idpost DESC";
$res = mysqli_query($connection, $query) or die(mysqli_error($connection));
$array_post = array();
if(mysqli_num_rows($res) > 0){
    while($result = mysqli_fetch_assoc($res)){

        $array_post[] = array('idpost'=> $result['idpost'],'iduser' => $result['user'], 'number_likes' => $result['number_likes'],
                            'number_comments' => $result['number_comments'], 'image' => $result['image'], 
                            'descrizione' => $result['descrizione'], 'tips' => $result['tips'], 'username' => $result['username'], 
                            'nome' => $result['nome'], 'cognome' => $result['cognome'], 'number_posts' => $result['number_posts'], 
                            'image_profile' => $result['image_profile']);
        
    }
    
}
else{
    /*Non ci sono post da mostrare*/
    $array_post[]= array('correct' => false);
}

mysqli_free_result($res);
mysqli_close($connection);

echo json_encode($array_post);
?>