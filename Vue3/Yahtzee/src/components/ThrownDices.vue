<template>
    <div class="thrown-dices-container">
        <div class="dice-row" :class="{throwing: isThrowingDice}">
            <DiceRender
                v-for="(dice, index) in diceArray"
                :key="index"
                :ref="
                    el => {
                        diceRefs[index] = el;
                    }
                "
                :class="{
                    'dice-animate': isThrowingDice,
                    'dice-delay-1': index % 5 === 1,
                    'dice-delay-2': index % 5 === 2,
                    'dice-delay-3': index % 5 === 3,
                    'dice-delay-4': index % 5 === 4,
                }"
            />
        </div>
        <div class="controls">
            <button @click="throwDice" :disabled="isThrowingDice">Throw Dice</button>
        </div>
        <div class="dice-info">
            <p>Individual Values: {{ diceValues.join(', ') }}</p>
            <p>Total: {{ totalValue }}</p>
        </div>
    </div>
</template>

<script setup>
import {ref, computed} from 'vue';
import DiceRender from './DiceRender.vue';

const diceArray = ref([{}, {}, {}, {}, {}]);
const diceRefs = ref([]);
const isThrowingDice = ref(false);

const diceValues = computed(() => {
    return diceRefs.value.filter(ref => ref).map(ref => ref.currentValue);
});

const totalValue = computed(() => {
    return diceValues.value.reduce((sum, val) => sum + val, 0);
});

const throwDice = () => {
    isThrowingDice.value = true;

    // Roll all dice simultaneously
    diceRefs.value.forEach(diceRef => {
        if (diceRef) {
            diceRef.rollDice();
        }
    });

    // Reset throwing state after animation completes
    setTimeout(() => {
        isThrowingDice.value = false;
    }, 1000); // Match this with the CSS animation duration
};
</script>

<style scoped>
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

.dice-animate {
    animation: throwDice 1s ease-out forwards;
}

/* Slightly different timing for each die */
.dice-delay-1 {
    animation-delay: 0.05s;
}
.dice-delay-2 {
    animation-delay: 0.1s;
}
.dice-delay-3 {
    animation-delay: 0.15s;
}
.dice-delay-4 {
    animation-delay: 0.2s;
}

@keyframes throwDice {
    0% {
        transform: translateY(-100px) rotateX(0deg) rotateY(0deg) rotateZ(0deg);
    }
    50% {
        transform: translateY(20px) rotateX(720deg) rotateY(360deg) rotateZ(360deg);
    }
    75% {
        transform: translateY(-10px) rotateX(810deg) rotateY(450deg) rotateZ(450deg);
    }
    100% {
        transform: translateY(0) rotateX(900deg) rotateY(540deg) rotateZ(540deg);
    }
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
}

.controls button:hover:not(:disabled) {
    border-color: #666;
    background: #f5f5f5;
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
