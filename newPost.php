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
        <title>Nuovo_Post</title>
        <meta charset="utf-8" />
        <link rel = "stylesheet" href = "./stile/home.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Smooch&display=swap" rel="stylesheet">
        <script src="./scripts/newPost.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <main>
        <header>
            <nav>
            <div id = 'logo'> City-Tips </div>
            <div>
            <a href = "home.php" id = 'home'> Home </a>
            <a href = 'preferiti.php'>Preferiti</a>
            <a href="logout.php" >Logout</a>
            </div>
            </nav>
        </header>
        <section id = "new_post">
            <div id ="flex">
                <strong>Nuovo Post </strong>
                <p>Descrivi la tua esperienza di viaggio e in più qualche consiglio per aiutare altri amanti dei viaggi come te! </p>
            </div>
            <form method = 'post' id = 'ricerca'>
                    <label> Seleziona il contenuto che vuoi caricare (Immagine o Sticker) </label>
                    <div class ='select'>
                    <label><input data-radio-id="1" type="radio" name="type" value="image" class = 'radio' ><img data-image-id="1" class= 'image' src = './images/image_search.png'></label>
                    <label><input data-radio-id="2" type="radio" name="type" value="giphy" class = 'radio' ><img data-image-id="2" class= 'image' src = './images/image_sticker.png'></label>
                    </div>
                    <div id="div_input">
                        <div><label><input type = 'text'  name='ricerca' id = 'search_input'></label></div>
                        <label><input type = 'submit' value = 'Cerca'></label>
                    </div>
                    
            </form>
            <form method = 'post' id = 'second'>
                <label>Descrizione<textarea name="textarea" maxlength="1500" placeholder="Scrivi qui"></textarea></label>
                <label><input type="checkbox" name = 'tips' value= 'tips' id = "check_tip">Inserire dei consigli</label>
                <div class = 'hidden' id = 'div_tip' >
                    <label>Consiglio<textarea name="textarea_tips" maxlength="100" placeholder="Scrivi qui"></textarea></label> 
                </div>
                <label>&nbsp;<input type='submit' id = 'submit' value='Pubblica'></label>
            </form>
            
        </section>
        <section class = 'hidden results'> 
            
            <div data-choice-id="1">
                <label><input data-radio-id = '1' type="radio" name="select" value="1" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="2">
                <label><input data-radio-id = '2' type="radio" name="select" value="2" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="3">
                <label><input data-radio-id = '3' type="radio" name="select" value="3" class = 'select_radio' form = 'second' ></label>
            </div>

            <div data-choice-id="4">
                <label><input data-radio-id = '4' type="radio" name="select" value="4" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="5">
                <label><input data-radio-id = '5' type="radio" name="select" value="5" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="6">
               <label><input data-radio-id = '6' type="radio" name="select" value="6" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="7">
                <label><input data-radio-id = '7' type="radio" name="select" value="7" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="8">
                <label><input data-radio-id = '8' type="radio" name="select" value="8" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="9">
                <label><input data-radio-id = '9'  type="radio" name="select" value="9" class = 'select_radio' form = 'second'></label>
            </div>
            <div data-choice-id="10">
                <label><input data-radio-id = '10'  type="radio" name="select" value="10" class = 'select_radio' form = 'second' ></label>  
            </div>
            <div data-choice-id="11">
                <label><input data-radio-id = '11' type="radio" name="select" value="11" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="12">
                <label><input data-radio-id = '12' type="radio" name="select" value="12" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="13">
                <label><input data-radio-id = '13' type="radio" name="select" value="13" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="14">
                <label><input data-radio-id = '14' type="radio" name="select" value="14" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="15">
                <label><input data-radio-id = '15' type="radio" name="select" value="15" class = 'select_radio' form = 'second'></label>
            </div>

            <div data-choice-id="16">
                <label><input data-radio-id = '16' type="radio" name="select" value="16" class = 'select_radio' form = 'second'></label>
            </div>
             
      </section>



        <section id = 'modal-view' class = 'hidden'>
        </section>
        
        <section id ='post_caricato' class = 'hidden fixed font'>
                <div>
                    <p class = 'errore'> Post caricato correttamente!</p> <br><br>
                    <a href = 'home.php'> Torna alla home </a>
                    <a href = 'newPost.php'> Pubblica nuovo post </a>
                </div>
         </section>
        <section id ='post_noncaricato' class = 'hidden fixed font'>
                <div>
                    <p class = 'errore'> Errore caricamento Post</p> <br><br>
                    <a href = 'newPost.php'> Carica nuovo Post </a>
                </div>
        </section>


        </main>
        <footer>
            <em> Alessandro Genovese 1000002043 </em>
        </footer>
    </body>
</html>
