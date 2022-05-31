<?php
 require_once 'autenticazione.php';

 if (checkAutenticazione()) {
     header("Location: home.php");
     exit;
 }   

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["nome"]) && 
        isset($_POST["cognome"]) && isset($_POST["conferma_password"]))
    {
        $connection = mysqli_connect($dbconf['host'] , $dbconf['user'], $dbconf['password'], $dbconf['name']) or die(mysqli_error($connection));

        $array_err = array();
        
        
        //email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            //$array_err[] = "Errore: Email non valida, modificarla";
            echo "<h1>Errore: Email non valida, modificarla</h1>";
            exit;
            
        } 
        else {
            $strlow = strtolower($_POST['email']);
            $email = mysqli_real_escape_string($connection, $strlow);
            $result = mysqli_query($connection, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($result) > 0) {
                echo "<h1>Errore: Email già utilizzata, modificarla</h1>";
                exit;
            }
            mysqli_free_result($result);

        }
        //username
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username']) ) {
            echo "<h1>Errore: Username non valido</h1>";
            exit;

        } 
        else {
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $query = "SELECT username FROM users WHERE username = '$username'";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                echo "<h1>Errore: Errore username già utilizzato, modificarlo <h1> ";
                exit;
            }
            mysqli_free_result($result);

        }
        //password
        if (strlen($_POST["password"]) < 5) {
            echo "<h1>Errore: Password troppo corta, modoficare password</h1>";
            exit;
        } 
        //conferma password
        if(strcmp($_POST["password"], $_POST["conferma_password"]) != 0){
            echo "<h1>Errore: Le due password non coincidono</h1>";
            exit;
        }
        
         if (count($array_err) == 0) {
            
            $nome = mysqli_real_escape_string($connection, $_POST['nome']);
            $cognome = mysqli_real_escape_string($connection, $_POST['cognome']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);
            	
            $query = "INSERT INTO users(username, password, email, nome, cognome) VALUES('$username', '$password', '$email', '$nome', '$cognome')";
            $query2= "SELECT id FROM users where username = '$username'";
            if (mysqli_query($connection, $query)) {
                $res = mysqli_query($connection, $query2);
                if(mysqli_num_rows($res) > 0){
                    mysqli_close($connection);
                    header("Location: login.php");
                    exit;
                }
            } else {
               
               echo "<h1>Errore, riempi tutti i campi</h1>";
               exit;
            }
        }

        mysqli_close($connection);

    }

        

else if (isset($_POST["username"]) || isset($_POST["password"]) || isset($_POST["email"]) || isset($_POST["nome"]) || 
            isset($_POST["cognome"]) || isset($_POST["conferma_password"])) {
    
   echo"<h1>Errore, riempi tutti i campi</h1>";
   exit;
    
}

?>