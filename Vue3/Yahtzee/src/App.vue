<template>
    <ThrownDices :dice-object="diceObject" @dice-rolled="updateDices" />
    <Scoretable :dices="diceArray" />
</template>

<script setup>
import {ref, reactive, computed} from 'vue';
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

const updateDices = rolledDice => {
    // Reset de waarde van de count
    Object.keys(diceObject).forEach(key => {
        diceObject[key] = 0;
    });
    // Telt de nieuwe waarde van de gegooide dobbels
    rolledDice.forEach(value => {
        diceObject[value]++;
    });
    console.log(diceArray.value);
};
</script>

<style scoped></style>
