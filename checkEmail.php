<?php
require_once 'database_config.php';

if (!isset($_GET["q"])) {
    echo "<h1> Error </h1>";
    exit;
}



$connection = mysqli_connect($dbconf['host'], $dbconf['user'], $dbconf['password'], $dbconf['name']) or die("Errore: ".mysqli_connect_error());
$email = mysqli_real_escape_string($connection, $_GET['q']);
$query = "SELECT email FROM users WHERE email = '$email'";
$res = mysqli_query($connection, $query) or die(mysqli_error($connection));
if(mysqli_num_rows($res) > 0 ){
    $control = array('exist'=> true);
    
}
else{
    $control = array('exist' => false);
}
mysqli_free_result($res);
mysqli_close($connection);
echo json_encode($control);

?>