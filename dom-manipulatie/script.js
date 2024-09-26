const myName = 'Elwin';

const button = document.getElementById('clickButton');
const greeting = document.getElementById('greeting');

const kleuren = ['blue', 'green', 'yellow', 'purple', 'red']; // array van kleuren 

const randomKleur = () => {
    return kleuren[(Math.floor(Math.random()* kleuren.length))]; // kiest een randomKleur() van kleuren
};

    
const showGreeting = () => {

    if (greeting.style.display === "none") {  // kijkt of greeting on-/ zichtbaar is, maakt het anders  on-/ zichtbaar
        
        greeting.style.display = "block";
        
        greeting.style.color = randomKleur(); // geeft greeting een de kleur van randomKleur
        
        greeting.innerHTML = `Hello ${myName}!`; // zett tekst van 'greeting' 
        
    } else {
        greeting.style.display = "none";
    }

}

button.addEventListener("click", showGreeting); // verbind de actie van op de 'button' clicken aan  'showGreeting'



