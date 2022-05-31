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
$query = "INSERT INTO likes(user, post) VALUES('$username', '$idpost')";

$query2 = "SELECT number_likes FROM posts WHERE idpost = $idpost"; //restituirà una riga

$res = mysqli_query($connection, $query) or die("Errore: ".mysqli_connect_error());



if($res){
    
    $res2= mysqli_query($connection, $query2);
    if(mysqli_num_rows($res2)){
        
        $result = mysqli_fetch_assoc($res2);
        $array = array('number_likes' => $result['number_likes'], 'idpost' => $idpost, 'error' => false);
        
        

    }
    else {
        $array = array('error' => true);
        mysqli_free_result($res2);
        mysqli_close($connection);
        echo json_encode($array);
        exit;
    }
}
else{
    $array = array('error' => true);
    mysqli_free_result($res2);
    mysqli_close($connection);
    echo json_encode($array);
    exit;
}

mysqli_free_result($res2);
mysqli_close($connection);
echo json_encode($array);
exit;



?>