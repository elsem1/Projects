<template>
    <ThrownDices
        ref="thrownDicesRef"
        :dices="diceObject"
        @dice-rolled="updateDices"
        @score-selected="handleScoreSelected"
        @activate-score-selection="activateScoreSelection"
    />
    <ScoreTable
        :dices="diceObject"
        :is-selecting-score="isSelectingScore"
        :selected-scores="selectedScores"
        @score-selected="handleScoreSelected"
    />
</template>

<script setup>
import {reactive, ref} from 'vue';
import ScoreTable from './components/ScoreTable.vue';
import ThrownDices from './components/ThrownDices.vue';

const diceObject = reactive({
    1: 0,
    2: 0,
    3: 0,
    4: 0,
    5: 0,
    6: 0,
});

const selectedScores = reactive({
    upper: Array(6).fill(null),
    lower: Array(7).fill(null),
});

const isSelectingScore = ref(false);
const thrownDicesRef = ref(null);

const updateDices = rolledDice => {
    Object.keys(diceObject).forEach(key => {
        diceObject[key] = 0;
    });
    rolledDice.forEach(value => {
        diceObject[value]++;
    });
    console.log('Updated Dice Object:', diceObject);
};

const handleScoreSelected = ({resetDice}) => {
    isSelectingScore.value = false;
    if (resetDice) {
        resetDiceForNewRound();
    }
};

const activateScoreSelection = () => {
    isSelectingScore.value = true;
};

const resetDiceForNewRound = () => {
    if (thrownDicesRef.value) {
        thrownDicesRef.value.resetDice();
    }
};
</script>

<style scoped></style>
