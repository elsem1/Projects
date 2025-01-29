<template>
    <ThrownDices
        :dices="diceObject"
        @dice-rolled="updateDices"
        @score-selected="handleScoreSelected"
        @activate-score-selection="activateScoreSelection"
    />
    <Scoretable :dices="diceObject" :is-selecting-score="isSelectingScore" @score-selected="handleScoreSelected" />
</template>

<script setup>
import {reactive, computed, ref} from 'vue';
import Scoretable from './components/ScoreTable.vue';
import ThrownDices from './components/ThrownDices.vue';

const diceObject = reactive({
    1: 0,
    2: 0,
    3: 0,
    4: 0,
    5: 0,
    6: 0,
});

const diceArray = computed(() => Object.values(diceObject));
const isSelectingScore = ref(false);

const updateDices = rolledDice => {
    Object.keys(diceObject).forEach(key => {
        diceObject[key] = 0;
    });
    rolledDice.forEach(value => {
        diceObject[value]++;
    });
    console.log(diceArray.value);
};

const handleScoreSelected = index => {
    isSelectingScore.value = false;
    console.log(`Score selected`);
};

const activateScoreSelection = () => {
    isSelectingScore.value = true;
};
</script>

<style scoped></style>
