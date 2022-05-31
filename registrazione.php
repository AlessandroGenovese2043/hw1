<?php

 require_once 'autenticazione.php';

 if (checkAutenticazione()) {
     header("Location: home.php");
     exit;
 }   

?>

<html>
    <head>
        <title>Registrazione</title>
        <meta charset="utf-8" />
        <link rel = "stylesheet" href = "./stile/registrazione.css">
        <script src="./scripts/registrazione.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <main>
        <section>
        <header>
            <h1> Registrazione</h1>
        </header>
        <form method='post' action="./reg.php">
            <label>Nome <input type='text' name='nome' id= 'nome'></label>
            <label>Cognome <input type='text' name='cognome' id ='cognome'></label>
            <label>E-mail <input type='text' name='email' id = 'email'></label>
            <label>Username <input type='text' name='username' id = 'username'></label>
            <label>Password <input type='password' name='password' id = 'password'></label>
            
            <label>Conferma Password <input type='password' name='conferma_password' id = 'conferma_password'></label>
            <label><a href="login.php">Accedi</a><input type='submit' id = 'submit' value='Registrati'></label>
            <div class = 'campo'></div>
            <div class = 'cognome'></div>
            <div class = 'username'></div>
            <div class = 'email'></div>
            <div class = 'password'></div>
            <div class = 'conferma_password'></div>
        </form>
</section>
        
        </main>
        
    </body>
</html>