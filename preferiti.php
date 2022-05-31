<?php 

require_once 'database_config.php';
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}





?>


<html>
<head>
        <title>Preferiti</title>
        <meta charset="utf-8" />
        <link rel = "stylesheet" href = "./stile/home.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Smooch&display=swap" rel="stylesheet">
        <script src="./scripts/preferiti.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <main>
        <header>
            <nav>
            <div id = 'logo'> City-Tips </div>
            <div>
            <a href = "home.php" id = 'home'> Home </a>
            <a href = "newPost.php"> Nuovo Post </a>
            <a href="logout.php" >Logout</a>
            </div>
            </nav>
        </header>
        <section id = "new_post">
            <div id ="flex" class ='preferiti'>
                <strong>I tuoi Preferiti </strong>
                <seciton id ='feed' >

                </seciton>
            </div>
        </div>
        </main>
        <footer>
            <em> Alessandro Genovese 1000002043 </em>
        </footer>
    </body>
</html>
