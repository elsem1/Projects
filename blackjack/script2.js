const fullDeck = document.getElementsByClassName("deck");
const hit = document.getElementById("hit");
const start = document.getElementById("start");
const pass = document.getElementById("pass");
const playerScore = document.getElementById("playerScore");
const dealerScore = document.getElementById("dealerScore");

const suits = ["spades", "diamonds", "clubs", "hearts"];
const values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];

// Create deck
const getDeck = () => suits.flatMap(suit => values.map(value => ({ Value: value, Suit: suit })));

// Deal a card to a player or dealer
const dealCard = (deck, target, isFaceDown = false) => { // Combined function for dealing cards
    if (deck.length === 0) return;

    const r = Math.floor(Math.random() * deck.length);
    const cardDealt = deck.splice(r, 1)[0];
    target.push(cardDealt);

    const displayCard = document.getElementById(`${target === playerCards ? "player" : "dealer"}CardsDealt`);
    const cardElement = dealCard(cardDealt.Value, cardDealt.Suit, isFaceDown);
    displayCard.appendChild(cardElement);

    if (isFaceDown) dealerFaceDownCard = cardElement;
};

// Simplified start hand dealing
const dealStartingHand = () => {
    dealCard(deck, playerCards);
    dealCard(deck, dealerCards);
    dealCard(deck, playerCards);
    dealCard(deck, dealerCards, true);
};

// Simplified score counting
const scoreCount = cards => {
    const totalScore = cards.reduce((acc, card) => acc + appointValueToCards[card.Value], 0);
    const aceCount = cards.filter(card => card.Value === "A").length;

    return aceCount > 0 && totalScore > 21 ? totalScore - 10 * aceCount : totalScore;
};

// Combine common win-check logic
const checkWinner = (playerTotal, dealerTotal) => {
    if (dealerTotal > 21) return `Bust! Dealer's total score is ${dealerTotal}. Player wins!`;
    if (dealerTotal === playerTotal) return "Draw! Dealer Wins!";
    return dealerTotal > playerTotal ? `${dealerTotal} to ${playerTotal}. Dealer Wins!` : `${dealerTotal} to ${playerTotal}. Player Wins!`;
};

// Streamlined dealer's turn
const dealerPlays = () => {
    turnCard();
    let dealerTotal = scoreCount(dealerCards);

    while (dealerTotal < 17) {
        dealCard(deck, dealerCards);
        dealerTotal = scoreCount(dealerCards);
    }

    endGame(checkWinner(scoreCount(playerCards), dealerTotal)); // Use helper function for checking winner
};

// Simplified Blackjack check
const checkBlackJack = () => {
    const playerTotal = scoreCount(playerCards);
    const dealerTotal = scoreCount(dealerCards);

    if (playerTotal === 21 || dealerTotal === 21) {
        if (playerTotal === 21 && dealerTotal === 21) {
            endGame("Push! Both Player and Dealer have Blackjack! No one wins!");
        } else if (playerTotal === 21) {
            endGame("Blackjack! Player wins!");
        } else {
            endGame("Blackjack! Dealer wins!");
        }
    } else {
        hit.disabled = false;
        pass.disabled = false;
    }
};

let deck = getDeck();
let playerCards = [];
let dealerCards = [];
let dealerFaceDownCard = null;

const resetGame = () => {
    document.getElementById("playerCardsDealt").innerHTML = '';
    document.getElementById("dealerCardsDealt").innerHTML = '';

    deck = getDeck();
    playerCards = [];
    dealerCards = [];
    dealerFaceDownCard = null;

    playerScore.innerHTML = '';
    dealerScore.innerHTML = '';
    console.log("New game started.");
};

const endGame = message => {
    console.log(message);
    turnCard();
    hit.disabled = true;
    pass.disabled = true;
};

// Simplified event listeners
start.addEventListener("click", () => {
    console.log("Game started!");
    resetGame();
    dealStartingHand();
    checkBlackJack();
    playerScore.innerHTML = `Player score: ${scoreCount(playerCards)}`;
});

hit.addEventListener("click", () => {
    console.log("Hit clicked, card dealt.");
    dealCard(deck, playerCards);
    const playerTotal = scoreCount(playerCards);
    playerScore.innerHTML = `Player score: ${playerTotal}`;

    if (playerTotal > 21) {
        endGame(`Bust! Your total score is ${playerTotal}. Dealer wins!`);
    }
});

pass.addEventListener("click", () => {
    console.log("Player passed. Dealer's turn");
    dealerPlays();
});
