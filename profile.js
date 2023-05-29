function onResponse(response) {
    return response.json();
}

function fetchFavoriteJson(json){
    console.log(json);
    const circuitContainer = document.querySelector('.circuits');
    circuitContainer.innerHTML='';

    if(json.length == 0){
        const noCircuit = document.createElement('h3');
        noCircuit.textContent = "Nessun circuito preferito";
        circuitContainer.appendChild(noCircuit);
        return;
    }

    for(let i in json){
        const circuit = document.createElement('div');
        circuit.classList.add('circuit_box');
        circuit.dataset.id = json[i].id;
        const img = document.createElement('img');
        img.classList.add('photo');
        img.src= "./img_database_circuit/" + json[i].picture;
        const textContainer = document.createElement('div');
        const name = document.createElement('p');
        name.textContent = json[i].name;
        const star = document.createElement('img');
        star.classList.add('star');

        const formData = new FormData();
        formData.append('circuitid', json[i].id);
        fetch("upload_star.php", {method: 'post', body: formData}).then(onResponse).then(function(json){return updateStar(json, star)});

        textContainer.appendChild(name);
        textContainer.appendChild(star);

        circuit.appendChild(img);
        circuit.appendChild(textContainer);
        
        circuitContainer.appendChild(circuit);
    }
}

function updateStar(json, star){
    if(json.full === true){
        star.addEventListener('click', unstarCircuit);
        star.src= "./image/star_full.png";
    }
    else{
        star.addEventListener('click', starCircuit);
        star.src= "./image/star_empty.png";
    }
}

function starCircuit(event){
    const button = event.currentTarget;

    const formData = new FormData();
    formData.append('circuitid', button.parentNode.parentNode.dataset.id);
    fetch("star_circuit.php", {method: 'post', body: formData}).then(onResponse);

    button.src = "./image/star_full.png";
    button.removeEventListener('click', starCircuit);
    button.addEventListener('click', unstarCircuit);
    
}

function unstarCircuit(event){
    const button = event.currentTarget;

    const formData = new FormData();
    formData.append('circuitid', button.parentNode.parentNode.dataset.id);
    fetch("unstar_circuit.php", {method: 'post', body: formData}).then(onResponse);

    fetchFavorites();
}

function fetchFavorites(){
    fetch("fetch_favorite.php").then(onResponse).then(fetchFavoriteJson);
}

fetchFavorites();