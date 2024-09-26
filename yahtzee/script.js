const diceTable = document.getElementById("resultsTable");
const diceResult = document.getElementsByClassName("diceResult");
const button = document.getElementById("throw");
const upperHalf = document.getElementById("upperSection");
const part1 = document.getElementById("part1");
const game = document.getElementsByClassName("game"); 
const totalUp = document.getElementById("totalUp");
const bonusUp = document.getElementById("bonusUp");
const threeOfAKind = document.getElementById("threeOfAKind");
const totalUpTotal = document.getElementsByClassName("totalUpTotal"); 
const yahtzee = document.getElementById("yahtzee");
const carre = document.getElementById("carre");
const fullHouse = document.getElementById("fullHouse");
const bigStrait = document.getElementById("bigStrait");
const smallStrait = document.getElementById("smallStrait");
const totalLower = document.getElementById("totalLower");
const chance = document.getElementById("chance");
const genTotal = document.getElementById("generalTotal");


const count = { // houd het aantal gegooide ogen bij
    1: 0,
    2: 0,
    3: 0,
    4: 0,
    5: 0,
    6: 0,
};

const diceValues = []
const rollDice = () => {   
    for (let i = 1; i <= 6; i++) { // Zet de count weer op 0 en verhoogt deze voor iedere gegooit dobbelresultaat
        count[i] = 0;                
    }
    
   
    for (let i = 0; i < 5; i++) {
        const result = Math.floor(Math.random() * 6) + 1; // Gooit 5 dobbels
        diceValues.push(result);
        diceResult[i].innerHTML = diceValues[i]; // Zet het resultaat van diceValues in het HTML element
        count[result] += 1;
    } 
    
    diceValues.sort(); 
    console.log(diceValues);
    console.log(sumDiceValues());
    calcUpperScore();
    bonusUp.innerHTML = calcUpperScore() >= 63 ? 35 : 0; 
    totalUpTotal[0].innerHTML = calcTotalUp();
    totalUpTotal[1].innerHTML = calcTotalUp();
    threeOfAKind.innerHTML = xOfAKind(3) ? sumDiceValues() : 0;    
    carre.innerHTML = xOfAKind(4) ? sumDiceValues() : 0;
    fullHouse.innerHTML = funcFullHouse() ? 25 : 0;
    smallStrait.innerHTML = funcStraight(4) ?  30 : 0;
    bigStrait.innerHTML = funcStraight(5) ?  40 : 0;
    yahtzee.innerHTML = xOfAKind(5) ? 50 : 0;
    chance.innerHTML = sumDiceValues();
    calcPairs();
    totalLower.innerHTML = calcLowerScore();
    genTotal.innerHTML = calcGenTotal();
    diceValues.length = 0;
};


const calcPairs = () => { // doet alle ogen die hetzelfde zijn keer hoevaak deze zijn gegooid.
    for (const key in count) {
            const value = count[key];
            const total = key * value;
            game[key -1].innerHTML = total;        
    }
}

const calcUpperScore = () => { // berekent de totaal voor iedere zijde van de dobbel
    
    totalUp.innerHTML = sumDiceValues();

    return sumDiceValues();    
};    

const sumDiceValues = () => { // berekent het totaal van alle ogen
    const sumWithinitial = diceValues.reduce(
        (accumulator, currentValue) => accumulator + currentValue, 0);
    return sumWithinitial;
} 

const calcTotalUp = () => {
    return Number(totalUp.innerHTML) + Number(bonusUp.innerHTML);
};

const xOfAKind = (valueToCheck) => { // kijkt of er 3,4 of 5 dezelfde dobbels zijn gegooid
    for (const key in count) {
        if (count[key] >= valueToCheck) {
            return true;
        }
    };
    return false;
};

const funcFullHouse = () => { // kijkt of er een fullhouse is gegooid en returnt dan true
    return (
        (diceValues[0] === diceValues[2] && diceValues[3] === diceValues[4] || 
        diceValues[0] === diceValues[1] && diceValues[2] === diceValues[4]) 
        );
        
};   

const funcStraight = (straightNumber) => { // kijkt of er 4 of 5 opeenvolgende dobbels zijn gegooid en returnt dan true
    let numCount = 0;
    
    for (const key in count) {
        if (count[key] >= 1) {
            numCount++;
        } else {
            numCount = 0
        }        
        
        if(numCount >= straightNumber) return true        
    }
    return false
};  

const calcLowerScore = () => { // berekent de totaal onderste helft
    return (
    Number(threeOfAKind.innerHTML) + 
    Number(carre.innerHTML) + 
    Number(fullHouse.innerHTML) + 
    Number(smallStrait.innerHTML) + 
    Number(bigStrait.innerHTML) + 
    Number(yahtzee.innerHTML) + 
    Number(chance.innerHTML)
    ); 
};
    
const calcGenTotal = () => {   // berekent totaalscore  
        return calcLowerScore() + calcTotalUp();
}; 

button.addEventListener("click", rollDice); // Wanneer er op de button geklikt wordt, wordt de rollDice functie uitgevoerd


