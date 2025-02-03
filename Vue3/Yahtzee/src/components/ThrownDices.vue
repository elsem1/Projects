<template>
    <div class="thrown-dices-container">
        <div class="dice-row">
            <DiceRender
                v-for="i in 5"
                :key="i"
                :ref="el => setDiceRef(el, i - 1)"
                :value="diceValues[i - 1]"
                :is-held="isHeld[i - 1]"
                @click="toggleHold(i - 1)"
                :class="{throwing: isRolling, [`dice-delay-${i}`]: isRolling}"
            />
        </div>

        <div class="controls">
            <button @click="resetDice" :disabled="reset">Reset Dice</button>
            <button @click="rollDice" :disabled="isRolling">Roll Dice</button>
            <button @click="useScore" :disabled="scoreUsed">Use Score</button>
        </div>
    </div>
</template>

<script setup>
import {ref} from 'vue';
import DiceRender from './DiceRender.vue';

const emit = defineEmits(['dice-rolled', 'score-selected', 'activate-score-selection']);
const diceRefs = ref([]);
const isRolling = ref(false);
const reset = ref(true);
const scoreUsed = ref(true);
const diceValues = ref(Array(5).fill(1));
const isHeld = ref(Array(5).fill(false));
let rolls = 0;
const isSelectingScore = ref(false);

const useScore = () => {
    isSelectingScore.value = true;
    emit('activate-score-selection');
};

const setDiceRef = (el, index) => {
    if (el) {
        diceRefs.value[index] = el;
    }
};

const resetDice = () => {
    // Reset de dobbelstenen zowel in waarde als in animatie
    isHeld.value = Array(5).fill(false);
    diceValues.value = Array(5).fill(1);
    isRolling.value = false;
    scoreUsed.value = true;
    reset.value = true;
    rolls = 0;

    diceRefs.value.forEach(diceRef => {
        if (diceRef) {
            diceRef.rollDice(1, true);
        }
    });

    emit('dice-rolled', diceValues.value);
};

const rollDice = async () => {
    if (isRolling.value) return;
    isRolling.value = true;
    scoreUsed.value = true;
    reset.value = false;

    const rollPromises = diceRefs.value.map((diceRef, index) => {
        return new Promise(resolve => {
            setTimeout(() => {
                if (diceRef && !isHeld.value[index]) {
                    const newValue = Math.floor(Math.random() * 6) + 1;
                    diceValues.value[index] = newValue;
                    diceRef.rollDice(newValue);
                    resolve(newValue);
                } else {
                    resolve(diceValues.value[index]);
                }
            }, index * 50);
        });
    });

    const rolledValues = await Promise.all(rollPromises);
    rolledValues.sort((a, b) => a - b);
    emit('dice-rolled', rolledValues);
    rolls++;
    console.log(rolls);
    console.log('Rolled Values:', rolledValues);
    setTimeout(() => {
        if (rolls <= 2) {
            scoreUsed.value = false;
            isRolling.value = false;
        } else {
            scoreUsed.value = false;
            isRolling.value = true;
        }
    }, 0);
};

const toggleHold = index => {
    isHeld.value[index] = !isHeld.value[index];
    console.log(`Dice ${index + 1} is held:`, isHeld.value[index]);
};

defineExpose({
    resetDice,
});
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

#cube.held {
    border: 2px solid #9c33ff;
    background-color: #ffe6e6;
}
</style>
