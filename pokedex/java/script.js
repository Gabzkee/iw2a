const pokemonName = document.querySelector('.pokemon_name');
const pokemonNumber = document.querySelector('.pokemon_number');
const pokemonImage = document.querySelector('.pokemon_image');
const pokemonType = document.querySelector('.pokemon_type');
const form = document.querySelector('.form');
const input = document.querySelector('.input_search');
const buttonPrev = document.querySelector('.btn-prev');
const buttonNext = document.querySelector('.btn-next');
const soundButton = document.querySelector('.sound');

let searchPokemon = 1;
let pokemonCryUrl = '';

const fetchPokemon = async (pokemon) => {
    const APIResponse = await fetch(`https://pokeapi.co/api/v2/pokemon/${pokemon}`);

    if (APIResponse.status === 200) {
        const data = await APIResponse.json();
        return data;   
    }
}



const renderPokemon = async (pokemon) => {

    pokemonName.innerHTML = 'Loading';

    const data = await fetchPokemon(pokemon);
    if (data) {
        pokemonName.innerHTML = data.name;
        pokemonNumber.innerHTML = data.id;
        pokemonImage.src = data['sprites']['versions']['generation-viii']['icons']['front_default'];
        input.value ='';
        pokemonType.innerHTML = data['types']['0']['type']['name'];
        pokemonCryUrl = data['cries']['latest'];
        searchPokemon = data.id;
    } else {
        pokemonName.innerHTML = `Missing No.`;
        pokemonNumber.innerHTML = '???';
        pokemonImage.src = 'images/Missingno.webp';
        input.value ='';
    }
}

form.addEventListener('submit', (event) => {
    event.preventDefault();
    renderPokemon(input.value);

});

buttonPrev.addEventListener('click', () => {
    if (searchPokemon > 1){
        searchPokemon -= 1;
        renderPokemon(searchPokemon)
    }
    
});

if(pokemonType == 'fire')
    

buttonNext.addEventListener('click', () => {
    searchPokemon += 1;
    renderPokemon(searchPokemon);
});

soundButton.addEventListener('click', () => {
    if (pokemonCryUrl) {
        const audio = new Audio(pokemonCryUrl);
        audio.play();
    } else {
        alert('Nenhum som disponível!');
    }
});

renderPokemon(searchPokemon)