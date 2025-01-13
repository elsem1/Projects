<template>
    <div id="Yahtzee app">
        <title>Vue Yahtzee</title>

        <!-- <table id="resultsTable">
            <tbody>
                <tr>
                    <td v-for="dice in dices" :key="dice" class="diceResult">{{ dice }}</td>
                </tr>
            </tbody>
        </table> -->

        <table id="upperSection">
            <thead>
                <tr id="part1">
                    <th>Upper Section</th>
                    <th colspan="2">How to score</th>
                    <th v-for="n in 5" :key="n">Game #{{ n }}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(label, index) in upperSectionLabels" :key="index">
                    <td colspan="3">{{ label }}</td>
                    <td v-for="n in 5" :key="n" class="game">{{ scores[index] || 0 }}</td>
                </tr>
                <tr>
                    <td colspan="3">Totaal aantal punten</td>
                    <td id="totalUp">0</td>
                    <td v-for="n in 4" :key="n" class="game"></td>
                </tr>
                <tr>
                    <td>Bonus</td>
                    <td>Als puntentotaal 63 of meer is</td>
                    <td>35 punten</td>
                    <td id="bonusUp">0</td>
                    <td v-for="n in 4" :key="n" class="game"></td>
                </tr>
                <tr>
                    <td>Totaal</td>
                    <td colspan="2">van de bovenste helft</td>
                    <td class="totalUpTotal">0</td>
                    <td v-for="n in 4" :key="n" class="game"></td>
                </tr>
            </tbody>
        </table>

        <table id="lowerSection">
            <thead>
                <tr>
                    <th>Lower Section</th>
                    <th colspan="2"></th>
                    <th v-for="n in 5" :key="n"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in lowerSectionLabels" :key="index">
                    <td>{{ item.name }}</td>
                    <td>{{ item.condition }}</td>
                    <td>{{ item.points }}</td>
                    <td class="game">{{ scores[index] || 0 }}</td>
                    <td v-for="n in 4" :key="n" class="game"></td>
                </tr>
                <tr>
                    <td>Totaal</td>
                    <td colspan="2">van de bovenste helft</td>
                    <td class="totalUpTotal">0</td>
                    <td v-for="n in 4" :key="n" class="game"></td>
                </tr>
                <tr>
                    <td colspan="3">Totaal Generaal</td>
                    <td id="generalTotal">0</td>
                    <td v-for="n in 4" :key="n" class="game"></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
defineProps({
    dices: Array,
});

const upperSectionLabels = ['Enen = 1', 'Tweeën = 2', 'Drieën = 3', 'Vieren = 4', 'Vijven = 5', 'Zessen = 6'];

const lowerSectionLabels = [
    {name: 'Three of a kind', condition: '3 dezelfde', points: 'Totaal v.d. 5 stenen'},
    {name: 'Carré', condition: '4 dezelfde', points: 'Totaal v.d. 5 stenen'},
    {name: 'Full House', condition: '2 + 3 dezelfde', points: '25 punten'},
    {name: 'Kleine straat', condition: '4 opeenvolgende nummers', points: '30 punten'},
    {name: 'Grote Straat', condition: '5 opeenvolgende nummers', points: '40 punten'},
    {name: 'Yahtzee', condition: '5 dezelfde', points: '50 punten'},
    {name: 'Chance', condition: 'Vrije keus', points: 'Totaal v.d. 5 stenen'},
];

const scores = [];
</script>

<style scoped>
#app {
    font-family: 'Arial', sans-serif;
    padding: 20px;
    background-color: #f9f9f9;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th,
td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
    min-width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

th {
    background-color: #4caf50;
    color: white;
}

td.game {
    background-color: #eaf2f8;
}

.diceResult {
    font-size: 2em;
    font-weight: bold;
    color: #333;
}

#resultsTable {
    margin-top: 20px;
    margin-bottom: 40px;
}

#upperSection th,
#lowerSection th {
    background-color: #8bc34a;
}

td.game2,
td.game3,
td.game4,
td.game5 {
    background-color: #fff;
}

td {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 1em;
}

td.long-text {
    font-size: 0.8em;
}

td.long-text p {
    font-size: 0.7em;
}
</style>
