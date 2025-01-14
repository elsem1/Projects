<template>
    <ThrownDices />
    <Scoretable :dices="diceArray" />
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
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

const updateDices = (newDices) => {
    newDices.forEach((value, index) => {
        diceObject[index + 1] = value;
    });
};
</script>

<style scoped></style>
