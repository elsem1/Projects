<template>
    <div id="Yahtzee-app">
        <title>Vue Yahtzee</title>

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
                    <td v-for="n in 5" :key="n" class="game">{{ upperSectionScores[index] || 0 }}</td>
                </tr>
                <tr>
                    <td colspan="3">Totaal aantal punten</td>
                    <td id="totalUp">{{ totalUpper }}</td>
                    <td v-for="n in 4" :key="n" class="game"></td>
                </tr>
                <tr>
                    <td>Bonus</td>
                    <td>Als puntentotaal 63 of meer is</td>
                    <td>35 punten</td>
                    <td id="bonusUp">{{ bonus }}</td>
                    <td v-for="n in 4" :key="n" class="game"></td>
                </tr>
                <tr>
                    <td>Totaal</td>
                    <td colspan="2">van de bovenste helft</td>
                    <td class="totalUpTotal">{{ totalUpper + bonus }}</td>
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
                    <td class="game">{{ lowerSectionScores[index] || 0 }}</td>
                    <td v-for="n in 4" :key="n" class="game"></td>
                </tr>
                <tr>
                    <td>Totaal</td>
                    <td colspan="2">van de onderste helft</td>
                    <td class="totalLowerTotal">{{ totalLower }}</td>
                    <td v-for="n in 4" :key="n" class="game"></td>
                </tr>
                <tr>
                    <td colspan="3">Totaal Generaal</td>
                    <td id="generalTotal">{{ totalUpper + bonus + totalLower }}</td>
                    <td v-for="n in 4" :key="n" class="game"></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    dices: Object,
});

const upperSectionLabels = ['Enen = 1', 'Tweeën = 2', 'Drieën = 3', 'Vieren = 4', 'Vijven = 5', 'Zessen = 6'];

const lowerSectionLabels = [
    { name: 'Three of a kind', condition: '3 dezelfde', points: 'Totaal v.d. 5 stenen' },
    { name: 'Carré', condition: '4 dezelfde', points: 'Totaal v.d. 5 stenen' },
    { name: 'Full House', condition: '2 + 3 dezelfde', points: '25 punten' },
    { name: 'Kleine straat', condition: '4 opeenvolgende nummers', points: '30 punten' },
    { name: 'Grote Straat', condition: '5 opeenvolgende nummers', points: '40 punten' },
    { name: 'Yahtzee', condition: '5 dezelfde', points: '50 punten' },
    { name: 'Chance', condition: 'Vrije keus', points: 'Totaal v.d. 5 stenen' },
];

const upperSectionScores = computed(() => {
    return upperSectionLabels.map((_, index) => {
        const diceValue = index + 1;
        return props.dices[diceValue] * diceValue || 0;
    });
});

const totalUpper = computed(() => {
    return upperSectionScores.value.reduce((sum, score) => sum + score, 0);
});

const bonus = computed(() => {
    return totalUpper.value >= 63 ? 35 : 0;
});

const lowerSectionScores = computed(() => {
    const counts = Object.values(props.dices);
    const totalDice = counts.reduce((sum, count) => sum + count, 0);

    return lowerSectionLabels.map(item => {
        if (item.name === 'Three of a kind' && counts.some(count => count >= 3)) {
            return totalDice;
        } else if (item.name === 'Carré' && counts.some(count => count >= 4)) {
            return totalDice;
        } else if (item.name === 'Full House' && counts.includes(3) && counts.includes(2)) {
            return 25;
        } else if (item.name === 'Kleine straat' && hasStraight(counts, 4)) {
            return 30;
        } else if (item.name === 'Grote Straat' && hasStraight(counts, 5)) {
            return 40;
        } else if (item.name === 'Yahtzee' && counts.includes(5)) {
            return 50;
        } else if (item.name === 'Chance') {
            return totalDice;
        } else {
            return 0;
        }
    });
});

const totalLower = computed(() => {
    return lowerSectionScores.value.reduce((sum, score) => sum + score, 0);
});

const hasStraight = (counts, length) => {
    let consecutive = 0;
    for (let i = 0; i < counts.length; i++) {
        if (counts[i] > 0) {
            consecutive++;
            if (consecutive >= length) return true;
        } else {
            consecutive = 0;
        }
    }
    return false;
};
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
