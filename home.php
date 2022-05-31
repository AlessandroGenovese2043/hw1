<?php 

    require_once 'database_config.php';
    session_start();

    if(!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
    
    
    $connection = mysqli_connect($dbconf['host'], $dbconf['user'], $dbconf['password'], $dbconf['name']) or die(mysqli_error($connection));
    $username = mysqli_real_escape_string($connection, $_SESSION['username']);
    $query = "SELECT * FROM users WHERE username = '$username'";
    $res = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $user = mysqli_fetch_assoc($res);
    
    mysqli_free_result($res);
    mysqli_close($connection);
    
    
    if (isset($_POST["foto_profilo"])){
        
        $connection = mysqli_connect($dbconf['host'], $dbconf['user'], $dbconf['password'], $dbconf['name']) or die(mysqli_error($connection));
        $foto = mysqli_real_escape_string($connection, $_POST['foto_profilo']);
        echo $foto;
        $userid = mysqli_real_escape_string($connection, $user['id']);
        echo $userid;
        $query = "UPDATE users SET image_profile = '$foto' WHERE users.id = '$userid'";
        if (mysqli_query($connection, $query)) {
            
            exit;
        } else {
            $error[] = "Errore di connessione al Database";
        }
    }

?>



<html>
<head>
        <title>Home</title>
        <meta charset="utf-8" />
        <link rel = "stylesheet" href = "./stile/home.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Smooch&display=swap" rel="stylesheet">
        <script src="./scripts/home.js" defer></script>
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
            <a href = 'preferiti.php'>Preferiti</a>
            <a href="logout.php" >Logout</a>
            </div>
            </nav>
        </header>
        <div id='sezioni'>
            <section class = 'profile'>
            <div id="profile-flex">
            <div id="profile">
                <img src='https://pianetasocial.it/wp-content/uploads/2013/10/faccia.jpg'>
            </div>
            <?php 
            
            echo "<p>@$username</p>";

            ?>
            </div>
            <p> Nome: <?php echo $user['nome'] ?> </p>
            <p> Cognome: <?php echo $user['cognome'] ?> </p>
            <p> Email: <?php echo $user['email'] ?> </p>
            <p> Numero di post: <?php echo $user['number_posts'] ?> </p>
            
            </section>
            <section id = 'feed'>
   
            </section>
        </div>
        </main>
        <footer>
            <em> Alessandro Genovese 1000002043 </em>
        </footer>
    </body>
</html>
