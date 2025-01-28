<template>
    <div class="thrown-dices-container">
        <div class="dice-row">
            <DiceRender v-for="i in 5" :key="i" :ref="el => setDiceRef(el, i - 1)" :value="diceValues[i - 1]"
                :is-held="isHeld[i - 1]" @click="toggleHold(i - 1)"
                :class="{ throwing: isRolling, [`dice-delay-${i}`]: isRolling }" />
        </div>

        <div class="controls">
            <button @click="rollDice" :disabled="isRolling">Roll Dice</button>
            <button @click="useScore" :disabled="scoreUsed">Use Score</button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import DiceRender from './DiceRender.vue';

const emit = defineEmits(['dice-rolled']);
const diceRefs = ref([]);
const isRolling = ref(false);
const scoreUsed = ref(true);
const diceValues = ref(Array(5).fill(1)); // Zorgt dat iedere dobbel op 1 begint
const isHeld = ref(Array(5).fill(false)); // Zorgt ervoor dat alle dobbels mee kunnen draaien

const setDiceRef = (el, index) => {
    if (el) {
        diceRefs.value[index] = el;
    }
};

const rollDice = async () => {
    if (isRolling.value) return;
    isRolling.value = true;

    const rollPromises = diceRefs.value.map((diceRef, index) => {
        return new Promise((resolve) => {
            setTimeout(() => {
                if (diceRef && !isHeld.value[index]) {
                    const newValue = Math.floor(Math.random() * 6) + 1;
                    diceValues.value[index] = newValue;
                    diceRef.rollDice(newValue);
                    resolve(newValue);
                } else {
                    resolve(diceValues.value[index]);
                }
            }, index * 200);
        });
    });

    const rolledValues = await Promise.all(rollPromises);
    rolledValues.sort((a, b) => a - b);
    emit('dice-rolled', rolledValues);
    console.log('Rolled Values:', rolledValues);

    setTimeout(() => {
        isRolling.value = false;
    }, 2500);
};

const toggleHold = (index) => {
    isHeld.value[index] = !isHeld.value[index];
    console.log(`Dice ${index + 1} is held:`, isHeld.value[index]);
};

const useScore = () => {

}
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

<!-- <template>
    <div class="thrown-dices-container">
        <div class="dice-row">
            // Pass the dice value and isHeld state as props to DiceRender
            <DiceRender
                v-for="i in 5"
                :key="i"
                :ref="el => setDiceRef(el, i - 1)"
                :value="diceValues[i - 1]"
                :is-held="isHeld[i - 1]"
                @hold="toggleHold(i - 1)"
                :class="{ throwing: isRolling, [`dice-delay-${i}`]: isRolling }"
            />
        </div>

        <div class="controls">
            <button @click="rollDice" :disabled="isRolling">Roll Dice</button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import DiceRender from './DiceRender.vue';

const emit = defineEmits(['dice-rolled']);
const diceRefs = ref([]);
const isRolling = ref(false);

// State for dice values and held status
const diceValues = ref(Array(5).fill(1)); // Initialize all dice with value 1
const isHeld = ref(Array(5).fill(false)); // Initialize all dice as not held

const setDiceRef = (el, index) => {
    if (el) {
        diceRefs.value[index] = el;
    }
};

const rollDice = async () => {
    if (isRolling.value) return;
    isRolling.value = true;

    const rollPromises = diceRefs.value.map((diceRef, index) => {
        return new Promise((resolve) => {
            setTimeout(() => {
                if (diceRef && !isHeld.value[index]) {
                    const newValue = Math.floor(Math.random() * 6) + 1;
                    diceValues.value[index] = newValue; // Update the dice value
                    diceRef.rollDice(newValue); // Trigger animation in DiceRender
                    resolve(newValue);
                } else {
                    resolve(diceValues.value[index]); // Keep the held dice value
                }
            }, index * 200); // Staggered rolling effect
        });
    });

    const rolledValues = await Promise.all(rollPromises);
    rolledValues.sort((a, b) => a - b);
    emit('dice-rolled', rolledValues);
    console.log('Rolled Values:', rolledValues);

    setTimeout(() => {
        isRolling.value = false;
    }, 2500);
};

const toggleHold = (index) => {
    isHeld.value[index] = !isHeld.value[index]; // Toggle the held state
};
</script>

<style scoped>
.thrown-dices-container {
    text-align: center;
}

.dice-row {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
}

.controls {
    margin-top: 20px;
}

.throwing {
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    50% { transform: translateX(10px); }
    75% { transform: translateX(-10px); }
}

.dice-delay-1 { animation-delay: 0s; }
.dice-delay-2 { animation-delay: 0.2s; }
.dice-delay-3 { animation-delay: 0.4s; }
.dice-delay-4 { animation-delay: 0.6s; }
.dice-delay-5 { animation-delay: 0.8s; }
</style> -->
