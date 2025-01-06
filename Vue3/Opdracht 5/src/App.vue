<script setup>

import { ref, reactive, nextTick } from 'vue'

const header = ref("Werken met V-for");
const tasks = ref([
  {
    name: "Boodschappen doen",
    completed: "false",
  },
  {
    name: "Afwassen",
    completed: "true",
  },
  {
    name: "Hond uitlaten",
    completed: "false",
  }
]);
const toggleCompleted = (task) => 
{
task.completed = !task.completed
}
</script>

<template>
  
  <header>
  <h1>{{ header }}</h1>
  </header>
  <ul>
    <h2>Tasks</h2>
    <li v-for="(task, index) in tasks" 
    @click="toggleCompleted(task)"
    :key="index"    
    >{{ task.name }} afgerond: {{ task.completed }}
  </li>  
  </ul>
  
</template>


