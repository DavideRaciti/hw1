//Array di stringhe da cercare su spotify
const playlist = ["Night drive", "Car music", "Roadtrip", "Auto playlist", "Bass boost car", "Song car" ];

function onResponse(response) {
    console.log(response);
    return response.json();
}

function onJson_Spotify(json){
    console.log('json ricevuto');
    console.log(json);

    const spotify = document.querySelector('#spotify');
    const playlist_div = document.createElement('div');
    const random_playlist = Math.floor(Math.random() * json.playlists.items.length);
    const playlist = json.playlists.items[random_playlist];
  
    const image = document.createElement('img');
    image.classList.add('thumbnail');
    image.src = playlist.images[0].url
  
    const playlist_name = document.createElement('h1');
    playlist_name.textContent = playlist.name;
  
    const playlist_link = document.createElement('a');
    playlist_link.classList.add('link');
    playlist_link.href = playlist.uri;
  
    const button_spotify = document.createElement('img');
    button_spotify.classList.add('play_button');
    button_spotify.src = "./image/spotify_button.png"
  
    playlist_link.appendChild(button_spotify);
  
    playlist_div.appendChild(image);
    playlist_div.appendChild(playlist_name);
    playlist_div.appendChild(playlist_link);

    playlist_div.classList.add('incolonna');

    spotify.appendChild(playlist_div);
}

for(let i = 0; i < 6; i++){
    const random_playlist = Math.floor(Math.random() * playlist.length);
    console.log(playlist[random_playlist]); 
    
    fetch("spotify.php?q="+encodeURIComponent(playlist[random_playlist])).then(onResponse).then(onJson_Spotify);
}
