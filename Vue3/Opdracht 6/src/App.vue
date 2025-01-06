<script setup>

import { ref, reactive, computed } from 'vue'
const header ="Computed Properties"
const people = ref([
  { 
    name: 'Jan', 
    age: 12 
  }, 
  { 
    name: 'Piet', 
    age: 20 
  },
  { 
    name: 'Robbert', 
    age: 75 
  }, 
  { 
    name: 'Anouk', 
    age: 32 
  }, 
]);
const newPerson = ref("");
const addPerson = () => {
   people.value.push (
    {
    name: newName.value,
    age: newAge.value,
  }),
  newName.value = ""
  newAge.value = ""
   }

</script>

<template>
  <header>
    <h1>{{ header }}</h1>
  </header>
  <form  
  <imput type="text" v-model="people.name">

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
