<template>
    <div>
        <button @click="rollDice">Roll Dice</button>

        <div v-for="(count, number) in diceCounts" :key="number">
            <p>{{ number }} : {{ count }}</p>
        </div>
    </div>
</template>

<script setup>
import {ref} from 'vue';

const diceCounts = ref({
    1: 0,
    2: 0,
    3: 0,
    4: 0,
    5: 0,
    6: 0,
});

const rollDice = () => {
    for (let key in diceCounts.value) {
        diceCounts.value[key] = 0;
    }

    for (let i = 0; i < 8; i++) {
        const result = Math.floor(Math.random() * 6) + 1;
        diceCounts.value[result] += 1;
    }
};
</script>

<style scoped></style>
