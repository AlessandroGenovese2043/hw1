<?php
    require_once 'database_config.php';
    session_start();
    
    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
    $flag = 0;
    $connection = mysqli_connect($dbconf['host'], $dbconf['user'], $dbconf['password'], $dbconf['name']) or die(mysqli_error($connection));
    $textarea = mysqli_real_escape_string($connection, $_POST['textarea']);
    if(isset($_POST['tips'])){
        $tips = mysqli_real_escape_string($connection, $_POST['tips']);
        $flag = 1;
    }
    
    $url = mysqli_real_escape_string($connection, $_POST['select']);
    $iduser = mysqli_real_escape_string($connection, $_SESSION['id']);
    if($flag == 1){
        $textarea2 = mysqli_real_escape_string($connection, $_POST['textarea_tips']);
        $query = "INSERT INTO posts(user, image, descrizione, tips) VALUES ('$iduser', '$url', '$textarea',' $textarea2')";

    }
    else{
        $query = "INSERT INTO posts(user, image, descrizione) VALUES ('$iduser', '$url', '$textarea')";
    }
    $res = mysqli_query($connection, $query) or die(mysqli_error($connection));
    
    if($res) {
        $control = array('correct' => true);
       
    }
    else{
        $control = array('correct' => false);
        
    }
    
    mysqli_close($connection);
    echo json_encode($control);
    
?>