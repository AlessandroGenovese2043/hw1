function onJsonCheckUsername(json){
    
    const div = document.querySelector('form div.username');
    if(json.exist){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p'); 
        errore.textContent = 'Username già esistente, modificarlo'; 
        div.appendChild(errore);
        scores.username = 0;
        checkSubmit();
        return false;
    }
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }
    }
    scores.username = 1;
    checkSubmit();

}

function onJsonCheckEmail(json){
    const div = document.querySelector('form div.email');
    if(json.exist){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p'); 
        errore.textContent = 'Email già esistente, modificarla'; 
        div.appendChild(errore);
        scores.email = 0;
        checkSubmit();
        return false;
    }
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }
    }
    scores.email = 1;
    checkSubmit();
}

function onSuccess(response) {
    console.log('Risposta ricevuta');
    if (!response.ok) {
        return null;
    }
    return response.json();
 }

function onError(error){
    console.log('Errore: ' + error)
}




function checkNome(event){
    const input = event.currentTarget;
    const div = document.querySelector('form div.campo');
   
    if(input.value == ""){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p'); 
        errore.textContent = 'Errore: riempire il campo '+input.name ; 
        div.appendChild(errore);
        scores.nome = 0;
        checkSubmit();
        return false;
    }
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }

    }
    scores.nome = 1;
    checkSubmit();
}

function checkCognome(event){
    const input = event.currentTarget;
    const div = document.querySelector('form div.cognome');
    
    if(input.value == ""){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p'); 
        errore.textContent = 'Errore: riempire il campo '+input.name ; 
        div.appendChild(errore);
        scores.cognome = 0;
        checkSubmit();
        return false;
    }
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }

    }
    scores.cognome = 1;
    checkSubmit();
}

function checkUsername(event){
    const input = event.currentTarget;
    const div = document.querySelector('form div.username');
    if(input.value == ""){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p'); 
        errore.textContent = 'Errore: riempire il campo '+input.name ; 
        div.appendChild(errore);
        scores.username = 0;
        checkSubmit();
        return false;
    }
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }

    }
    if(!/^[a-zA-Z0-9]{1,15}$/.test(input.value)){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p');
        errore.textContent = 'Username non valido inserire max 15 caratteri alfanumerici';
        div.appendChild(errore);
        scores.username = 0;
        checkSubmit();
        return false;
    }
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }
        fetch("checkUsername.php?q="+encodeURIComponent(input.value)).then(onSuccess, onError).then(onJsonCheckUsername);
        
    }
    scores.username = 1;
    checkSubmit();
}

function checkEmail(event){
    const input = event.currentTarget;
    const div = document.querySelector('form div.email');
    if(input.value == ""){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p'); 
        errore.textContent = 'Errore: riempire il campo '+input.name ; 
        div.appendChild(errore);
        scores.email = 0;
        checkSubmit();
        return false;
    }
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }

    }
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input.value).toLowerCase())) {
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p');
        errore.textContent = 'Mail non valida';
        div.appendChild(errore);
        scores.email = 0;
        checkSubmit();
        return false;
        
    } 
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }
        fetch("checkEmail.php?q="+encodeURIComponent(String(input.value).toLowerCase())).then(onSuccess, onError).then(onJsonCheckEmail);
    }
    scores.email = 1;
    checkSubmit();
}

function checkPass(event){
    const input = event.currentTarget;
    const div = document.querySelector('form div.password');
    if(input.value == ""){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p'); 
        errore.textContent = 'Errore: riempire il campo '+input.name ; 
        div.appendChild(errore);
        scores.password = 0;
        checkSubmit();
        return false;
    }
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }

    }
    if(input.value.length < 5){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p');
        errore.textContent = 'Password debole, inserire almeno 5 caratteri';
        div.appendChild(errore);
        scores.password = 0;
        checkSubmit();
        return false;
    }
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }
    }
     scores.password = 1;
     checkSubmit();

}

function checkConferm_pass(event){
    console.log(scores);
    const input = event.currentTarget;
    const div = document.querySelector('form div.conferma_password');
    if(input.value == ""){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p'); 
        errore.textContent = 'Errore: riempire il campo '+input.name ; 
        div.appendChild(errore);
        scores.conferma_password = 0;
        checkSubmit();
        return false;
    }
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }

    }
    if(input.value != document.querySelector('#password').value){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p');
        errore.textContent = 'Errore: le password non coincidono';
        div.appendChild(errore);
        scores.conferma_password = 0;
        checkSubmit();
        return false;
    }
    else{
        if(div.classList.contains('Errore')){
            div.classList.remove('Errore');
            div.innerHTML = '';
        }
    }
    scores.conferma_password = 1;
    checkSubmit();
}

function checkSubmit(event){
    let cont = 0;
    const submit = document.querySelector('#submit');
    for(let elem in scores){
        if(scores[elem] === 1){
            cont++;
        }
    }
    if(cont === 6){
        
        submit.classList.add('ok');
        return true;
    }
    else{
        if(submit.classList.contains('ok')){
            submit.classList.remove('ok');
        }
        return false;
    }
}

function Submit(event){
    if(!checkSubmit()){
       
        event.preventDefault();
    }
}

let nome = document.querySelector('#nome');
nome.addEventListener('blur', checkNome);
let cognome = document.querySelector('#cognome');
cognome.addEventListener('blur', checkCognome);
let username = document.querySelector('#username');
username.addEventListener('blur', checkUsername);
let email = document.querySelector('#email');
email.addEventListener('blur', checkEmail);
let password = document.querySelector('#password');
password.addEventListener('blur', checkPass);
password.addEventListener('blur', checkConferm_pass);

let conferma_password = document.querySelector('#conferma_password');
conferma_password.addEventListener('blur', checkConferm_pass);



const scores = {
    nome: 0,
    cognome: 0,
    username: 0,
    email: 0,
    password: 0,
    conferma_password: 0
};


const form = document.querySelector('form');
form.addEventListener('submit', Submit);
