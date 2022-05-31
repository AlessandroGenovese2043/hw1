
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
    console.log(!/^[a-zA-Z0-9]{1,15}$/.test(input.value));
    console.log(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input.value).toLowerCase()));
    if(!/^[a-zA-Z0-9]{1,15}$/.test(input.value) && !/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input.value).toLowerCase())){
        div.innerHTML = '';
        div.classList.add('Errore');
        const errore = document.createElement('p');
        errore.textContent = 'Username non valido';
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
    scores.password = 1;
    checkSubmit();

}
function checkSubmit(){
    let cont = 0;
    const submit = document.querySelector('#submit');
    for(let elem in scores){
        if(scores[elem] === 1){
            cont++;
        }
    }
    if(cont === 2){
        
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


let username = document.querySelector('#username');
username.addEventListener('blur', checkUsername);
let password = document.querySelector('#password');
password.addEventListener('blur', checkPass);
const form = document.querySelector('form');
form.addEventListener('submit', Submit);


const scores = {
    username: 0,
    password: 0
};