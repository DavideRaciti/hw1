function changeType(event){
    const chosenType = event.currentTarget;
    chosenType.classList.add("selected");

    const otherTypes = chosenType.parentNode.querySelectorAll(".type");
    for(const type of otherTypes){
        if(type.dataset.type !== chosenType.dataset.type){
            type.classList.remove('selected');
        }
    }
    typeSelected = chosenType.dataset.type;
    fetchCircuits();
}

function fetchCircuits(){
    fetch("fetch_circuits.php?type=" + typeSelected).then(onResponse).then(fetchCircuitsJson);
}

function onResponse(response) {
    return response.json();
}

function fetchCircuitsJson(json){
    console.log(json);
    const circuitContainer = document.querySelector('.circuits-div');
    circuitContainer.innerHTML='';

    for(let i in json){
        const circuit = document.createElement('div');
        circuit.classList.add('circuit_box');
        circuit.dataset.id = json[i].id;
        const img = document.createElement('img');
        img.classList.add('sfondo');
        img.src= "./img_database_circuit/" + json[i].picture;
        const textContainer = document.createElement('div');
        const name = document.createElement('p');
        name.textContent = json[i].name;
        const lenght = json[i].lenght;
        const lenghtTxt = document.createElement('p');
        lenghtTxt.textContent = 'Lunghezza: ' + lenght;
        const star = document.createElement('img');
        star.classList.add('star');

        const formData = new FormData();
        formData.append('circuitid', json[i].id);
 
        fetch("upload_star.php", {method: 'post', body: formData}).then(onResponse).then(function(json){return updateStar(json, star)});
        
        textContainer.appendChild(name);
        textContainer.appendChild(lenghtTxt);
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
    console.log(button.parentNode.parentNode.parentNode);
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

    button.src = "./image/star_empty.png";
    button.removeEventListener('click', unstarCircuit);
    button.addEventListener('click', starCircuit);
}

//Tipologia circuito selezionato
var typeSelected = "Automobilistici";
const types = document.querySelectorAll('.type');
for(const type of types){
    type.addEventListener('click', changeType);
}

fetchCircuits();