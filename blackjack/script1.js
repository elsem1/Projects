const fullDeck = document.getElementsByClassName("deck");
const hit = document.getElementById("hit");
const start = document.getElementById("start");
const pass = document.getElementById("pass");
const playerScore = document.getElementById("playerScore");
const dealerScore = document.getElementById("dealerScore");

const suits = ["spades", "diamonds", "clubs", "hearts"];
const values = [
  "A",
  "2",
  "3",
  "4",
  "5",
  "6",
  "7",
  "8",
  "9",
  "10",
  "J",
  "Q",
  "K",
];

const getDeck = () => {
  // Dit maakt een deck van 52 kaarten door iedere suite met een value te verbinden en pushed deze naar deck
  let deck = [];

  for (let i = 0; i < suits.length; i++) {
    for (let j = 0; j < values.length; j++) {
      // TODO: object keys in camelCase, dus value, suit
      let card = { Value: values[j], Suit: suits[i] };
      deck.push(card);
    }
  }
  return deck;
};

const dealStartingHand = () => {
  // Deelt de starthand aan dealer en player, de laatste dealerkaart is dicht

  dealCard(deck, playerCards);
  dealCard(deck, dealerCards);
  dealCard(deck, playerCards);
  dealCard(deck, dealerCards, true);
};

const createCard = (value, suit, isFaceDown = false) => {
  const card = document.createElement("div");
  card.className = "card";

  // Geeft de nieuw gecreerde elementen voor de card class informatie voor css, zodat deze de juiste opmaak krijgen van suit en value
  card.innerHTML = ` 
    <div class="corner top-left ${suit}">${value}</div>
    <div class="corner-suit top-left-suit ${suit}">${suitSymbol(suit)}</div>
    <div class="center-suit ${suit}">${suitSymbol(suit)}</div>
    <div class="corner bottom-right ${suit}">${value}</div>
    <div class="corner-suit bottom-right-suit ${suit}">${suitSymbol(suit)}</div>
    `;

  // Voegt een overlay toe voor de dichte kaart
  if (isFaceDown) {
    const overlay = document.createElement("div");
    overlay.className = "card-overlay";
    card.appendChild(overlay);
  }

  return card;
};

const suitSymbol = (suit) => {
  // Zorgt ervoor dat kaarten de juiste suit tonen
  switch (suit) {
    case "hearts":
      return "♥";
    case "diamonds":
      return "♦";
    case "spades":
      return "♠";
    case "clubs":
      return "♣";
    default:
      return "";
  }
};

let playerCards = [];
let dealerCards = [];

const dealCard = (deck, target, isFaceDown = false) => {
  // Deelt een random kaart van het gecreerde deck en deelt deze aan speler of dealer
  if (deck.length > 0) {
    // TODO: kies duidelijke naam voor variable, bijv. randomCardIndex, ipv r
    // TODO: gebruik const ipv let, omdat er geen re-assignment volgt
    let r = Math.floor(Math.random() * deck.length);
    let cardDealt = deck.splice(r, 1)[0];

    target.push(cardDealt);

    let displayCard = document.getElementById(
      `${target === playerCards ? "player" : "dealer"}CardsDealt`
    );
    let cardElement = createCard(cardDealt.Value, cardDealt.Suit, isFaceDown);
    displayCard.appendChild(cardElement);

    if (isFaceDown) {
      dealerFaceDownCard = cardElement;
    }
  }
};

const appointValueToCards = {
  A: 11,
  K: 10,
  Q: 10,
  J: 10,
  10: 10,
  9: 9,
  8: 8,
  7: 7,
  6: 6,
  5: 5,
  4: 4,
  3: 3,
  2: 2,
};

const scoreCount = (cards) => {
  // Berekend de totale score in de hand
  let totalScore = 0;
  let aceCount = 0;

  for (let card of cards) {
    const cardValue = appointValueToCards[card.Value]; // Haalt de waarde van de kaarten uit het kaart object

    totalScore += cardValue;

    if (card.Value === "A") {
      aceCount++;
    }
  }

  while (totalScore > 21 && aceCount > 0) {
    // Voor iedere aas in hand gaat er 10 van de score af wanneer deze boven de 21 is en wordt er 1 aas verrekend
    totalScore -= 10;
    aceCount--;
  }

  return totalScore;
};

// TODO: onderzoek of je de dealerPlays score controle en de checkBlackJack score controle kunt samenvoegen tot 1 functie die je
// hergebruikt in dealerPlays en checkBlackJack functie

const dealerPlays = () => {
  const playerTotal = scoreCount(playerCards);
  let dealerTotal = scoreCount(dealerCards);

  setTimeout(turnCard, 500);
  const dealerDraw = () => {
    if (dealerTotal < 17) {
      // Dealer blijft kaarten trekken totat score minimaal 17 is
      setTimeout(dealerDraw, 1200); // zet een vertraging in het kaarten trekken zodat dit niet allemaal ineens gebeurt

      dealCard(deck, dealerCards);
      dealerTotal = scoreCount(dealerCards);
    } else {
      if (dealerTotal > 21) {
        // Als de dealer geen kaarten meer trekt gaat een van de volgende scenarios in en wordt bekeken wie de winnaar is
        endGame(
          `Dealer bust! Dealer's total score is ${dealerTotal}. Player wins!`
        );
        playerWins++;
        showScore();
      } else if (dealerTotal === playerTotal) {
        endGame(`${dealerTotal} to ${playerTotal}. Draw! Dealer Wins!`);
        showScore();
      } else if (dealerTotal > playerTotal) {
        endGame(`${dealerTotal} to ${playerTotal}. Dealer Wins!`);
        dealerWins++;
        showScore();
      } else {
        endGame(`${dealerTotal} to ${playerTotal}. Player Wins!`);
        playerWins++;
        showScore();
      }
    }
  };
  setTimeout(dealerDraw, 1200);
  showScore();
};

const checkBlackJack = () => {
  // checkt voor blackjack
  const playerTotal = scoreCount(playerCards);
  const dealerTotal = scoreCount(dealerCards);

  if (playerTotal === 21 || dealerTotal === 21) {
    if (playerTotal === 21 && dealerTotal === 21) {
      endGame("Push! Both Player and Dealer have Blackjack! No one wins!");
    } else if (playerTotal === 21) {
      endGame("Blackjack! Player wins!");
      playerWins++;
      showScore();
    } else {
      endGame("Blackjack! Dealer wins!");
      dealerWins++;
      showScore();
    }
  } else {
    hit.disabled = false;
    pass.disabled = false;
  }
};

let deck = getDeck();

const resetGame = () => {
  // Spel wordt gereset, alle waardes weer op 0
  // TODO: zet onderstaande consts bovenaan je script voor hergebruik
  const playerCardsDealt = document.getElementById("playerCardsDealt");
  const dealerCardsDealt = document.getElementById("dealerCardsDealt");
  playerCardsDealt.innerHTML = "";
  dealerCardsDealt.innerHTML = "";
  showScore();

  deck = getDeck();
  playerCards = [];
  dealerCards = [];
  dealerFaceDownCard = null;

  playerScore.innerHTML = "";
  dealerScore.innerHTML = "";
  showMessage("New game started!", 2000);
};

const endGame = (message) => {
  // Weergeeft een bericht, blokkeert de speelknoppen en draait de gesloten kaart van dealer
  showMessage(message);
  setTimeout(turnCard, 500);
  hit.disabled = true;
  pass.disabled = true;
};

const turnCard = () => {
  if (dealerFaceDownCard) {
    const overlay = dealerFaceDownCard.querySelector(".card-overlay");
    if (overlay) {
      overlay.remove();
    }

    dealerFaceDownCard.classList.remove("facedown");

    dealerFaceDownCard = null;
  }
};

let playerWins = 0;
let dealerWins = 0;

const showScore = () => {
  let totalScore = document.querySelector(".totalScore");

  if (!totalScore) {
    totalScore = document.createElement("div");
    totalScore.className = "totalScore";
    document.body.appendChild(totalScore);
  }
  totalScore.innerHTML = `${dealerWins} - ${playerWins}`;
};

const showMessage = (content, duration = 5000) => {
  let tempMessage = document.createElement("div");
  tempMessage.className = "tempMessage";
  tempMessage.innerHTML = content;

  document.body.appendChild(tempMessage);

  tempMessage.style.display = "block";

  setTimeout(() => {
    tempMessage.style.display = "none";
    tempMessage.remove();
  }, duration);
};

start.addEventListener("click", () => {
  resetGame();
  dealStartingHand();
  checkBlackJack();
  playerScore.style.display = "block";
  playerScore.innerHTML += `Player score: ${scoreCount(playerCards)}`;
});

hit.addEventListener("click", () => {
  showMessage("Hit, another card is dealt!", 1000);
  dealCard(deck, playerCards);
  const playerTotal = scoreCount(playerCards);
  playerScore.innerHTML = `Player score: ${playerTotal}`;

  if (playerTotal > 21) {
    endGame(`Bust! Your total score is ${playerTotal}. Dealer wins!`);
    dealerWins++;
    showScore();
  }
});

pass.addEventListener("click", () => {
  showMessage("Player passed. Dealer's turn", 1500);
  dealerPlays();
});
