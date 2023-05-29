document.querySelector("#search form").addEventListener("submit", search);

function search(event){
    // Leggo il tipo e il contenuto da cercare e mando tutto alla pagina PHP
    const form_data = new FormData(document.querySelector("#search form"));
    const choice = document.querySelector('#tipo').value;

    if(choice === 'modello'){
        // Mando le specifiche della richiesta alla pagina PHP, che prepara la richiesta e la inoltra
        fetch("fetch_car_model.php?q="+encodeURIComponent(form_data.get('search'))).then(onResponse).then(onJson_CarModel);
    }else if(choice === 'marchio'){
        fetch("fetch_car_make.php?q="+encodeURIComponent(form_data.get('search'))).then(onResponse).then(onJson_CarMake);
    }

    // Evito che la pagina venga ricaricata
    event.preventDefault();
}

function transmissionTxt(transmission){
    if(transmission === 'a')
        return 'automatica';
    else
        return 'manuale';
}

//A seconda del tipo di trazione fornita dal json ne restituisce l'equivalente in italiano
function tractionTxt(traction){
    if(traction === "fwd")
        return 'anteriore';
    else if(traction === "rwd")
        return 'posteriore';
    else
        return 'integrale';
}

//A seconda del carburante fornito dal json restituisce l'equivalente in italiano
function fuel_typeTxt(fuel_type){
    if(fuel_type === 'gas')
        return 'benzina';
    else if(fuel_type === 'diesel')
        return 'diesel';
    else 
        return 'elettrica';
}

function onJson_CarModel(json){
    console.log('json car ricevuto');
    console.log(json);

    const grid = document.querySelector('#results');
    grid.innerHTML = '';

    if (json.status == 400){
        const errore = document.createElement("h1"); 
        const messaggio = document.createTextNode(json.detail); 
        errore.appendChild(messaggio); 
        grid.appendChild(errore);
        return
    }
    
    //Leggiamo i risultati
    const results = json;
      
    if(results.length == 0){
        const errore = document.createElement("h1"); 
        const messaggio = document.createTextNode("Nessun risultato, auto non presente!"); 
        errore.appendChild(messaggio); 
        grid.appendChild(errore);
    }

    for(const result of results){
        // Leggiamo le informazioni fornite fornite dal json, salviamo quelle necessarie e le appendiamo alla grid che le mostra tutte assieme
        
        const car_grid = document.createElement('div');
        const car_make = document.createElement('h1');
        car_make.textContent = "Marchio dell'auto: " + result.make;

        const car_class = document.createElement('h2');
        car_class.textContent = "Tipologia di auto: " + result.class;

        const traction = result.drive;
        const traction_text = document.createElement('p');
        traction_text.textContent = "Trazione: " + tractionTxt(traction) + " (" + traction + ")";

        const consumo_medio = document.createElement('p');
        consumo_medio.textContent = "Consumo medio: " + result.combination_mpg + "Km/L";

        const transmission = result.transmission;
        const transmission_text = document.createElement('p');
        transmission_text.textContent = 'Trasmissione: ' + transmissionTxt(transmission);

        const fuel_type = result.fuel_type;
        const fuel_type_text = document.createElement('p');
        fuel_type_text.textContent = "Carburante usato: " + fuel_typeTxt(fuel_type);

        car_grid.appendChild(car_make);
        car_grid.appendChild(car_class);
        car_grid.appendChild(traction_text);
        car_grid.appendChild(transmission_text);
        car_grid.appendChild(consumo_medio);
        car_grid.appendChild(fuel_type_text);

        grid.appendChild(car_grid);     
    }
}

function onJson_CarMake(json){
    console.log('json car ricevuto');
    console.log(json);

    const grid = document.querySelector('#results');
    grid.innerHTML = '';

    if (json.status == 400){
        const errore = document.createElement("h1"); 
        const messaggio = document.createTextNode(json.detail); 
        errore.appendChild(messaggio); 
        grid.appendChild(errore);
        return
    }
    
    //Leggiamo i risultati
    const results = json;
      
    if(results.length == 0){
        const errore = document.createElement("h1"); 
        const messaggio = document.createTextNode("Nessun risultato, auto non presente!"); 
        errore.appendChild(messaggio); 
        grid.appendChild(errore);
    }

    for(const result of results){
        // Leggiamo le info fornite dal json, salviamo quelle necessarie e le appendiamo alla grid che le mostra assieme
        
        const car_grid = document.createElement('div');
        const car_make = document.createElement('h1');
        car_make.textContent = "Marchio dell'auto: " + result.make;

        const car_class = document.createElement('h2');
        car_class.textContent = "Tipologia di auto: " + result.class;

        const cylinder = document.createElement('p');
        cylinder.textContent = "Numero di cilindri delle auto più potenti: " + result.cylinders;

        const example = document.createElement('p');
        example.textContent = "Un modello di questo marchio (" + result.make + ") è la " + result.model;

        car_grid.appendChild(car_make);
        car_grid.appendChild(car_class);
        car_grid.appendChild(cylinder);
        car_grid.appendChild(example);

        grid.appendChild(car_grid);    
    }
}

function onResponse(response) {
    return response.json();
}