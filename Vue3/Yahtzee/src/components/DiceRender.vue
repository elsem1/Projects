<script setup>
import {ref} from 'vue';

defineProps({
    value: {
        type: Number,
        required: true,
    },
    isHeld: {
        type: Boolean,
        default: false,
    },
});

const diceStyle = ref({});

const animateDice = (value, isReset = false) => {
    // Coordinaten voor elke zijde van de dobbel
    const rotations = {
        1: 'rotateX(0deg) rotateY(0deg)', // Voorkant
        2: 'rotateX(0deg) rotateY(180deg)', // Achterkant
        3: 'rotateX(0deg) rotateY(-90deg)', // Linkerkant
        4: 'rotateX(0deg) rotateY(90deg)', // Rechterkant
        5: 'rotateX(-90deg) rotateY(0deg)', // Onderkant
        6: 'rotateX(90deg) rotateY(0deg)', // Bovenkant
    };

    const selectedRotation = rotations[value];

    if (isReset) {
        // Zorgt voor instant animatie als de dobbelsteen worden gereset
        diceStyle.value = {
            transition: 'none',
            transform: 'rotateX(0deg) rotateY(0deg)',
        };
    } else {
        // Zorgt ervoor dat de dobbel in ieder geval 1x ronddraait en maximaal 3x
        const randomRotationX = 360 * (Math.floor(Math.random() * 3) + 1);
        const randomRotationY = 360 * (Math.floor(Math.random() * 3) + 1);
        const totalRotation = randomRotationX + randomRotationY;
        const maxRotation = 2160;

        // Berekent hoelang de dobbelsteel draait, afhankellijk van de hoeveelheid rotatie
        const duration = Math.min(3, (totalRotation / maxRotation) * 3);

        // Zorgt voor de draaianimatie en lengte van de worp
        diceStyle.value = {
            transition: `transform ${duration}s ease-in-out`,
            transform: `rotateX(${randomRotationX}deg) rotateY(${randomRotationY}deg) ${selectedRotation}`,
        };
    }
};

defineExpose({
    rollDice: (value, isReset = false) => {
        animateDice(value, isReset);
    },
});
</script>

<template>
    <div>
        <section class="container" :class="{held: isHeld}">
            <div id="cube" :style="diceStyle">
                <div class="face front">
                    <span class="dot dot1"></span>
                </div>
                <div class="face back">
                    <span class="dot dot1"></span>
                    <span class="dot dot2"></span>
                </div>
                <div class="face right">
                    <span class="dot dot1"></span>
                    <span class="dot dot2"></span>
                    <span class="dot dot3"></span>
                </div>
                <div class="face left">
                    <span class="dot dot1"></span>
                    <span class="dot dot2"></span>
                    <span class="dot dot3"></span>
                    <span class="dot dot4"></span>
                </div>
                <div class="face top">
                    <span class="dot dot1"></span>
                    <span class="dot dot2"></span>
                    <span class="dot dot3"></span>
                    <span class="dot dot4"></span>
                    <span class="dot dot5"></span>
                </div>
                <div class="face bottom">
                    <span class="dot dot1"></span>
                    <span class="dot dot2"></span>
                    <span class="dot dot3"></span>
                    <span class="dot dot4"></span>
                    <span class="dot dot5"></span>
                    <span class="dot dot6"></span>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>
.container {
    width: 60px;
    height: 60px;
    position: relative;
    margin: 0 auto;
    perspective: 300px;
    transform-style: preserve-3d;
}

#cube {
    width: 100%;
    height: 100%;
    position: absolute;
    transform-style: preserve-3d;
    transform: rotateX(0deg) rotateY(0deg);
    transition: transform 1s cubic-bezier(0.25, 0.1, 0.25, 1);
}

.held {
    border: 7px solid #e2d40c;
    border-radius: 10px;
}

.face {
    position: absolute;
    width: 100%;
    height: 100%;
    background: red;
    border: 1px solid darkred;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 1.5em;
    text-align: center;
    border-radius: 7px;
    box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.1);
    backface-visibility: hidden;
}

.front {
    transform: rotateY(0deg) translate3d(0, 0, 30px);
}

.back {
    transform: rotateY(180deg) translate3d(0, 0, 30px);
}

.right {
    transform: rotateY(90deg) translate3d(0, 0, 30px);
}

.left {
    transform: rotateY(-90deg) translate3d(0, 0, 30px);
}

.top {
    transform: rotateX(90deg) translate3d(0, 0, 30px);
}

.bottom {
    transform: rotateX(-90deg) translate3d(0, 0, 30px);
}

.dot {
    display: block;
    position: absolute;
    width: 10px;
    height: 10px;
    background: #3b0edf;
    border-radius: 50%;
}

/* Front face - 1 dot */
.front .dot1 {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* Back face - 2 dots */
.back .dot1 {
    top: 30%;
    left: 30%;
    transform: translate(-50%, -50%);
}

.back .dot2 {
    top: 70%;
    left: 70%;
    transform: translate(-50%, -50%);
}

/* Right face - 3 dots */
.right .dot1 {
    top: 30%;
    left: 30%;
    transform: translate(-50%, -50%);
}

.right .dot2 {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.right .dot3 {
    top: 70%;
    left: 70%;
    transform: translate(-50%, -50%);
}

/* Left face - 4 dots */
.left .dot1 {
    top: 30%;
    left: 30%;
    transform: translate(-50%, -50%);
}

.left .dot2 {
    top: 30%;
    left: 70%;
    transform: translate(-50%, -50%);
}

.left .dot3 {
    top: 70%;
    left: 30%;
    transform: translate(-50%, -50%);
}

.left .dot4 {
    top: 70%;
    left: 70%;
    transform: translate(-50%, -50%);
}

/* Top face - 5 dots */
.top .dot1 {
    top: 30%;
    left: 30%;
    transform: translate(-50%, -50%);
}

.top .dot2 {
    top: 30%;
    left: 70%;
    transform: translate(-50%, -50%);
}

.top .dot3 {
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.top .dot4 {
    top: 70%;
    left: 30%;
    transform: translate(-50%, -50%);
}

.top .dot5 {
    top: 70%;
    left: 70%;
    transform: translate(-50%, -50%);
}

.bottom .dot1 {
    top: 30%;
    left: 30%;
    transform: translate(-50%, -50%);
}

.bottom .dot2 {
    top: 30%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.bottom .dot3 {
    top: 30%;
    left: 70%;
    transform: translate(-50%, -50%);
}

.bottom .dot4 {
    top: 70%;
    left: 30%;
    transform: translate(-50%, -50%);
}

.bottom .dot5 {
    top: 70%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.bottom .dot6 {
    top: 70%;
    left: 70%;
    transform: translate(-50%, -50%);
}
</style>
