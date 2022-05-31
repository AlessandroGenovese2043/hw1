<?php


    require_once 'database_config.php';
    session_start();
    
    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

    
    
$connection = mysqli_connect($dbconf['host'], $dbconf['user'], $dbconf['password'], $dbconf['name']) or die(mysqli_error($connection));
$username = mysqli_real_escape_string($connection, $_SESSION['id']);
$query = "SELECT * FROM prefs JOIN users ON prefs.user = users.id";
$res = mysqli_query($connection, $query) or die(mysqli_error($connection));
$array_post = array();
if(mysqli_num_rows($res) > 0){
    while($result = mysqli_fetch_assoc($res)){

        $array_post[] = array('idprefs'=> $result['idpref'],'iduser' => $result['user'], 'idpost' => $result['post'],
                            'username' => $result['username'],'nome' => $result['nome'], 'cognome' => $result['cognome'],
                             'number_posts' => $result['number_posts'], 'utente_loggato' => $username, 'correct' => true);
        
    }
    
}
else{
    /*Non ci sono prefs da mostrare*/
    $array_post[]= array('correct' => false);
}

mysqli_free_result($res);
mysqli_close($connection);

echo json_encode($array_post);







?>