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
  const newName = ref("");
  const newAge = ref("");
  const addPerson = () => {
    if (newName.value && newAge.value) {
    people.value.push (
      {
      name: newName.value,
      age: newAge.value,
    }),
    newName.value = ""
    newAge.value = ""
    }
  }

  const children = computed(() => { 
    return people.value.filter((person) => {
      return person.age < 19
    })
  
  })

    

</script>

<template>
  <header>
    <h1>{{ header }}</h1>
  </header>
  <input type="text" v-model="newName" placeholder="What is your name?">
  <input type="text" v-model="newAge" placeholder="How old are you?">
  <button @click="addPerson">Add Person</button>
  
  <ul>
   <li v-for="(person, index) in people" :key="index">
      {{ person.name }} is {{ person.age }} years old
    </li>
  </ul>

  <ul>
   <li v-for="(person, index) in children" :key="index">
      {{ person.name }} is {{ person.age }} years old
    </li>
  </ul>
  
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
