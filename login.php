<?php
 require_once 'autenticazione.php';

 if (checkAutenticazione()) {
     header("Location: home.php");
     exit;
 }   
 
 if (!empty($_POST['username']) && !empty($_POST['password']) ){
    $connection = mysqli_connect($dbconf['host'] , $dbconf['user'], $dbconf['password'], $dbconf['name']) or die(mysqli_error($connection));
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    if(filter_var($username, FILTER_VALIDATE_EMAIL)){
        $toSearch = "email";
    } 
    else{
        $toSearch = "username";
    } 
    
    $query = "SELECT * FROM users WHERE $toSearch = '$username'";
    $res = mysqli_query($connection, $query) or die(mysqli_error($connection));
    if (mysqli_num_rows($res) > 0) {
        $result = mysqli_fetch_assoc($res);
        if (password_verify($_POST['password'], $result['password'])) {
            
            $_SESSION["username"] = $result['username'];
            $_SESSION["id"] = $result['id'];
            $_SESSION["nome"] = $result['nome'];
            $_SESSION["cognome"] = $result['cognome'];
            mysqli_free_result($res);
            mysqli_close($connection);
            header("Location: home.php");
            exit;
        }
    }
    $errore = "Username e/o password errati.";

 }
 else if (isset($_POST["username"]) || isset($_POST["password"])) {
    
    $errore = "Inserisci sia username sia password.";
}
?>

<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8" />
        <link rel = "stylesheet" href = "./stile/registrazione.css">
        <script src="./scripts/login.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <main>
        <section>
        <header>
            <h1> Login</h1>
        </header>
        <form method='post'>
            
            <label class = 'login' >Username o email <input type='text' name='username' id = 'username'></label>
            <label class = 'login'>Password <input type='password' name='password' id = 'password'></label>
            <label id = 'last_label'><a href="registrazione.php">Registrati</a><input type='submit' id = 'submit' value='Accedi'></label>
            <div class = 'username'></div>
            <div class = 'password'></div>
            <div class = 'errore'>
            <?php
            
            if (isset($errore)) {
                echo "<p>$errore</p>";
            }    
                
            ?>
            </div>
        </form>
</section>
        
        </main>
        
    </body>
</html>