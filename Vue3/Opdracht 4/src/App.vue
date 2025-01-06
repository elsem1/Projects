<script setup>
import {ref, reactive} from 'vue';

const counter = ref(0);
const person = reactive({
    firstName: '',
    country: '',
});
const editing = ref(false);
const doEdit = e => {
    editing.value = e;
};
const incrementCounter = () => {
    counter.value++;
};
</script>

<template>
    <button @click="incrementCounter">You clicked me {{ counter }} times.</button>
    <button v-if="editing" @click="doEdit(false)">Cancel</button>
    <button v-else @click="doEdit(true)">Edit person</button>

    <form class="add-person-form" v-if="editing">
        <div>
            <input type="text" id="firstName" v-model="person.firstName" placeholder="Type your first name here..." />
            <br />
            <input type="text" id="country" v-model="person.country" placeholder="Type your country here..." />
        </div>
    </form>

    <div>
        <label for="firstName">Your first name is {{ person.firstName }}</label>
        <br />
        <label for="country">You are from {{ person.country }}</label>
    </div>
</template>

<style scoped>
header {
    line-height: 1.5;
}

.logo {
    display: block;
    margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
    header {
        display: flex;
        place-items: center;
        padding-right: calc(var(--section-gap) / 2);
    }

    .logo {
        margin: 0 2rem 0 0;
    }

    header .wrapper {
        display: flex;
        place-items: flex-start;
        flex-wrap: wrap;
    }
}
</style>
