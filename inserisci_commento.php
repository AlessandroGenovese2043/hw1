<?php

require_once 'database_config.php';
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


   
$connection = mysqli_connect($dbconf['host'], $dbconf['user'], $dbconf['password'], $dbconf['name']) or die(mysqli_error($connection));
$username = mysqli_real_escape_string($connection, $_SESSION['username']);
$iduser = mysqli_real_escape_string($connection, $_SESSION['id']);
$idpost = mysqli_real_escape_string($connection, $_POST['idpost']);
$content = mysqli_real_escape_string($connection, $_POST['content']);
$query = "INSERT INTO comments(user, post,testo) VALUES('$iduser', '$idpost', '$content')";
$query2 = "SELECT number_comments FROM posts WHERE idpost = '$idpost'"; //restituirà una riga

$res = mysqli_query($connection, $query) or die(mysqli_error($connection));


if($res){
    
    $res2= mysqli_query($connection, $query2);
    if(mysqli_num_rows($res2)){
        
        $result = mysqli_fetch_assoc($res2);
        $array = array('number_comments' => $result['number_comments'], 'idpost' => $idpost, 'error' => false,
                        'username' => $username, 'testo' => $_POST['content'],  'nome' => $_SESSION["nome"], 'cognome' => $_SESSION['cognome']);
        
        

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