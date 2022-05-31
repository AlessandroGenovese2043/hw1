<?php

require_once 'database_config.php';
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


   
$connection = mysqli_connect($dbconf['host'], $dbconf['user'], $dbconf['password'], $dbconf['name']) or die(mysqli_error($connection));
$username = mysqli_real_escape_string($connection, $_SESSION['id']);
$idpost = mysqli_real_escape_string($connection, $_POST['idpost']);
$query = "INSERT INTO prefs(user, post) VALUES('$username', '$idpost')";


$res = mysqli_query($connection, $query) or die("Errore: ".mysqli_connect_error());



if($res){
    
    
        
    $array = array('error' => false, 'idpost' => $idpost);
        
}
else{
    $array = array('error' => true);
    
}

mysqli_close($connection);
echo json_encode($array);
exit;



?>