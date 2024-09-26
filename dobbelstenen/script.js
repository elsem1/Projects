let button = document.getElementById('throw');
const diceResult = document.getElementsByClassName('diceResult')

const count = { 
    1: 0,
    2: 0,
    3: 0,
    4: 0,
    5: 0,
    6: 0,
};

const rollDice = () => {

    for (let key in count) {
        count[key] = 0;
    }
    
    for (let i = 0; i < 8; i++) {
        const result = Math.floor(Math.random() * 6) + 1; // krijgt een random getal tussen 1-6
        count[result] += 1; // voegt 1 value toe aan count[result]
    }
        
    for (const key in count) {
        diceResult[key -1].innerHTML = count[key];  
};
};




button.addEventListener("click", rollDice);
