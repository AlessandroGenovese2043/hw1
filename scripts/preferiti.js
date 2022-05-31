
function button_tipsMostra(event){
    const button = event.currentTarget;
    const consigli = document.querySelectorAll('#feed p.consigli');
    for(const consiglio of consigli){
        if(consiglio.dataset.id_tip == button.dataset.id){
            if(consiglio.classList.contains('hidden')){
                consiglio.classList.remove('hidden');
            }
        }
    }

}

function button_tipsNascondi(event){
    const button = event.currentTarget;
    const consigli = document.querySelectorAll('#feed p.consigli');
    for(const consiglio of consigli){
        if(consiglio.dataset.id_tip == button.dataset.id){
            if(!consiglio.classList.contains('hidden')){
                consiglio.classList.add('hidden');
            }
        }
    }
}

function onJsonPreferiti(json){
    console.log('Json ricevuto');
    console.log(json);
    const results = json;
    console.log(results[0].correct);
    if(results[0].correct !== false){
        let b = 0;
        let c = 0;
        for(const result of results){
            console.log(result);
            const section = document.querySelector('#feed');
            const div1 = document.createElement('div');
            const username = document.createElement('strong');
            const breakLine = document.createElement('br');
            const name_surname = document.createElement('em');
            const div2 = document.createElement('div');
            const descrizione = document.createElement('p');
            const buttonMostra = document.createElement('button');
            const buttonNascondi = document.createElement('button');
            const consigli = document.createElement('p');
            const image = document.createElement('img');

            

            
           

           



            div2.appendChild(descrizione);
            div2.appendChild(buttonMostra);
            div2.appendChild(buttonNascondi);
            div2.appendChild(consigli);
            div2.appendChild(image);

            div1.appendChild(username);
            div1.appendChild(breakLine);
            div1.appendChild(name_surname);
            div1.appendChild(div2);

            section.appendChild(div1);

            image.src = result.image;
            username.textContent = '@'+result.username;
            name_surname.textContent = result.nome +' '+ result.cognome;
            descrizione.textContent = result.descrizione;
            consigli.textContent = result.tips;
            consigli.dataset.id_tip = c;
            consigli.classList.add('hidden');
            consigli.classList.add('consigli');
            buttonMostra.textContent = 'Mostra consigli';
            buttonNascondi.textContent = 'Nascondi consigli';
            buttonMostra.dataset.id = b;
            buttonNascondi.dataset.id = b;
            buttonMostra.addEventListener('click', button_tipsMostra);
            buttonNascondi.addEventListener('click', button_tipsNascondi);
            div2.classList.add('contenuto_div');
            div1.classList.add('div_feed');
            


            b++;    
            c++;
        }
    }
    else{
        const section = document.querySelector('#feed');
        const div1 = document.createElement('div');
        const text = document.createElement('strong');
        div1.classList.add('div_feed');
        text.textContent = 'Nessun post tra i preferiti';
        div1.appendChild(text);
        section.appendChild(div1);
        return;
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

function recuperaPreferiti(){

    fetch("recupera_postPreferiti.php").then(onSuccess, onError).then(onJsonPreferiti);
}


recuperaPreferiti();