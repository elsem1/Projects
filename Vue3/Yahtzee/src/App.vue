<template>
    <ThrownDices v-model="dices" />
    <Scoretable :dices="dices" />
</template>

<script setup>
import {ref, reactive} from 'vue';
import Scoretable from './components/ScoreTable.vue';
import ThrownDices from './components/ThrownDices.vue';

const dices = reactive({
    1: 0,
    2: 0,
    3: 0,
    4: 0,
    5: 0,
    6: 0,
});
</script>

<style scoped></style>
