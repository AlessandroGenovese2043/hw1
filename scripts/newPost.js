

function DivListener(event){
    const input = event.currentTarget.src;
    const image = document.createElement('img');
    image.src = input;
    const body = document.querySelector('body');
    body.classList.add('no_scroll');
    modale.style.top = window.pageYOffset + 'px';
    modale.appendChild(image);
    modale.classList.remove('hidden');
}

function click_modale(){
    const body = document.querySelector('body');
    body.classList.remove('no_scroll');
    modale.classList.add('hidden');
    modale.innerHTML = '';
    
}

function onJson(json){
    console.log('json ricevuto');
    console.log(json);
    const results = json.hits;
    const section = document.querySelector('section.results');
    let check = 0;
    if(results.length == 0){
        const errore = document.createElement('p'); 
        errore.classList.add('errore');
        errore.textContent = 'Errore, nessun risultato!' ; 
        section.appendChild(errore);
        section.classList.remove('hidden');
    }
    else{
        const alldiv = document.querySelectorAll('.results div');
        if(!section.classList.contains('hidden')){
            const images = document.querySelectorAll('.results div img');
            for(const image of images){
                image.remove();
            }
        }
        let images = [0];
        for(let j = 0; j < 30; j++){
            images[j] = 0;
        }
        let i = 0;
        
        for(const result of results){
            images[i] = result.webformatURL;
            i++;
        }
        i = 0;
        for(const div of alldiv){
            const image = document.createElement('img');
            image.src = images[i];
            i++;
            div.appendChild(image);
            image.addEventListener('click', DivListener);
            check = 1;
        
        }
        if(check = 1){
            i = 0;
            const input_radio = document.querySelectorAll('.select_radio');
            for(const elem of input_radio){
                elem.value = images[i];
                i++;
            }
        }
        section.classList.remove('hidden');
    }
   
}

function onJsonGiphy(json){
    console.log(json);
    const results = json.data;
    const section = document.querySelector('section.results');
    let check = 0;
    if(results.length == 0){
        const errore = document.createElement('p'); 
        errore.classList.add('errore');
        errore.textContent = 'Errore, nessun risultato!' ; 
        section.appendChild(errore);
        section.classList.remove('hidden');
    }
    else{
        const alldiv = document.querySelectorAll('.results div');
        if(!section.classList.contains('hidden')){
            const images = document.querySelectorAll('.results div img');
            for(const image of images){
                image.remove();
            }
        }
        let images = [0];
        for(let j = 0; j < 30; j++){
            images[j] = 0;
        }
        let i = 0;
        
        for(const result of results){
            images[i] = result.images.downsized.url;
            i++;
        }
        i = 0;
        for(const div of alldiv){
            const image = document.createElement('img');
            image.src = images[i];
            i++;
            div.appendChild(image);
            image.addEventListener('click', DivListener);
            check = 1;
        }
        if(check = 1){
            i = 0;
            const input_radio = document.querySelectorAll('.select_radio');
            for(const elem of input_radio){
                elem.value = images[i];
                i++;
            }
        }
        section.classList.remove('hidden');
    }
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


function search_Content(event){
    const form = document.querySelector('#ricerca');
    const form_data = new FormData(form);
    const content = form_data.get('type');
    const ricerca = form_data.get('ricerca');
    const request = "api.php?type="+ encodeURIComponent(content) + "&q=" + encodeURIComponent(ricerca);
    console.log(request);
    if(content === 'image'){
        fetch(request).then(onSuccess, onError).then(onJson);
    }
    else{
        fetch(request).then(onSuccess, onError).then(onJsonGiphy);
    }
    event.preventDefault();
    const div = document.querySelector('#div_input');
    const p = document.createElement('p');
    if(!div.classList.contains('font')){
        p.textContent = 'Scorri per vedere i risultati della ricerca'; 
        div.classList.add('font');
        div.appendChild(p);
    }
    
}


function radiofunc(event){
    const input = event.currentTarget;
    console.log(input);
    const allimage = document.querySelectorAll('.image');
    for(const image of allimage){
        if(image.dataset.imageId === input.dataset.radioId){
            if(!image.classList.contains('selected')){
                image.classList.add('selected');
            }
        }
        else{
            if(image.classList.contains('selected')){
                image.classList.remove('selected');
            }
        }
    }
}


function checkTip(event){
    const input = event.currentTarget;
    const div = document.querySelector('#div_tip');
    if(div.classList.contains('hidden')){
        div.classList.remove('hidden');
    }
    else{
        div.classList.add('hidden');
    }

}

const radioAll = document.querySelectorAll('.radio');
for(const radio of radioAll){
    radio.addEventListener('click', radiofunc);
}


function onClickElem(event){
    const input = event.currentTarget;
    if(!input.classList.contains('scelto')){

    }
}


function selected(event){
    const input = event.currentTarget;
    const alldiv = document.querySelectorAll('.results div');
    for(const div of alldiv){
        if(div.dataset.choiceId === input.dataset.radioId){
            div.classList.add('selected_radio');
            if(div.classList.contains('opacity')){
                div.classList.remove('opacity');
            }
        }
        else{
            if(div.classList.contains('selected_radio')){
                div.classList.remove('selected_radio');
            }
            if(!div.classList.contains('opacity')){
                div.classList.add('opacity');
            }
        }
    }
}

function onJsonCaricamento(json){
    console.log('json ricevuto');
    console.log(json);
    const $result = json.correct;
    const body = document.querySelector('body');
    if($result === false){
        const section = document.querySelector('#post_noncaricato');
        section.classList.add('caricamento_post');
        section.classList.remove('hidden');
        body.classList.add('no_scroll');
    }
    else{
        const section = document.querySelector('#post_caricato');
        section.classList.add('caricamento_post');
        section.classList.remove('hidden');
        body.classList.add('no_scroll');
    }
}

function submit(event){
    
    event.preventDefault();
    const form = document.querySelector('#second');
    const form_data = new FormData(form);
    console.log(form_data);
    const textarea = form_data.get('textarea');
    console.log(textarea);
    const tip = form_data.get('tips');
    console.log(tip);
    const textarea2 = form_data.get('textarea_tips');
    console.log(textarea2);
    const select = form_data.get('select');
    console.log(select);
    if(textarea === '' ){
        const section = document.querySelector('#post_noncaricato');
        const body = document.querySelector('body');
        const p = document.querySelector('#post_noncaricato p');
        p.textContent = 'Errore caricamento Post, scrivere una descrizione';
        section.classList.add('caricamento_post');
        section.classList.remove('hidden');
        body.classList.add('no_scroll');
        return;
    }
    if(select == null){
        const section = document.querySelector('#post_noncaricato');
        const body = document.querySelector('body');
        const p = document.querySelector('#post_noncaricato p');
        p.textContent = 'Errore caricamento Post, scegliere un immagine o uno sticker';
        section.classList.add('caricamento_post');
        section.classList.remove('hidden');
        body.classList.add('no_scroll');
        return;
    }
    const send_data = {method: 'post', body: form_data};
    fetch("caricamento_post.php", send_data).then(onSuccess, onError).then(onJsonCaricamento);

    


 
 }
const form1 = document.querySelector('#ricerca');
form1.addEventListener('submit', search_Content);

const tip = document.querySelector('#check_tip');
tip.addEventListener('change', checkTip);

const blocchi = document.querySelectorAll('.results div');
for(const elem of blocchi){
    elem.addEventListener('click', onClickElem);
}

const modale = document.querySelector('#modal-view');
modale.addEventListener('click',click_modale);

const radio_button = document.querySelectorAll('.select_radio');
for(const radio of radio_button){
    radio.addEventListener('click', selected);
}

const scores = {
    image: 0,
    descrizione: 0
};
const form = document.querySelector('#second');
form.addEventListener('submit', submit);