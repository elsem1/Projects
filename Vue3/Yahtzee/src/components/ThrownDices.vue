<template>
    <div class="thrown-dices-container">
        <div class="dice-row">
            <DiceRender
                v-for="i in 5"
                :key="i"
                :ref="el => setDiceRef(el, i - 1)"
                :class="{throwing: isRolling, [`dice-delay-${i}`]: isRolling}"
            />
        </div>

        <div class="controls">
            <button @click="rollDice" :disabled="isRolling">Roll Dice</button>
        </div>
    </div>
</template>

<script setup>
import {ref} from 'vue';
import DiceRender from './DiceRender.vue';

const emit = defineEmits(['dice-rolled']);
const diceRefs = ref([]);
const isRolling = ref(false);

const setDiceRef = (el, index) => {
    if (el) {
        diceRefs.value[index] = el;
    }
};

const rollDice = () => {
    if (isRolling.value) return;
    isRolling.value = true;

    let rolledValues = [];
    let completedRolls = 0;

    diceRefs.value.forEach((diceRef, index) => {
        if (diceRef && diceRef.rollDice) {
            setTimeout(() => {
                const newValue = Math.floor(Math.random() * 6) + 1;
                rolledValues[index] = newValue;
                diceRef.rollDice(newValue);

                completedRolls++;
                if (completedRolls === 5) {
                    // Emit pas wanneer alle dobbels zijn gegooid
                    rolledValues.value = rolledValues.sort();
                    emit('dice-rolled', rolledValues);
                    console.log(rolledValues);
                }
            }, index * 200);
        }
    });

    setTimeout(() => {
        isRolling.value = false;
    }, 3000);
};
</script>

<style scoped>
.throwing {
    animation: throwingAnimation 0.5s ease-in-out;
}

@keyframes throwingAnimation {
    0% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-15px) scale(1.05);
    }

    100% {
        transform: translateY(0);
    }
}

.thrown-dices-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2rem;
    padding: 2rem;
}

.dice-row {
    display: flex;
    flex-wrap: wrap;
    gap: 3rem;
    justify-content: center;
    perspective: 1000px;
}

.dice-delay-1 {
    animation-delay: 0s;
}

.dice-delay-2 {
    animation-delay: 0.1s;
}

.dice-delay-3 {
    animation-delay: 0.2s;
}

.dice-delay-4 {
    animation-delay: 0.3s;
}

.dice-delay-5 {
    animation-delay: 0.4s;
}

.controls {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.controls button {
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    border: 2px solid #ccc;
    background: white;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.2s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.controls button:hover:not(:disabled) {
    border-color: #666;
    background: #f5f5f5;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.controls button:active:not(:disabled) {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.controls button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.dice-info {
    text-align: center;
    font-size: 1.2rem;
    line-height: 1.5;
    margin-top: 1rem;
}
</style>
