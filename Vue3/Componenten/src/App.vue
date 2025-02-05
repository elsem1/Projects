<script setup>
import { ref, computed } from 'vue'
import GroceriesTable from './components/GroceriesTable.vue'

const list = ref([
  ['Brood', '1.00', 1],
  ['Broccoli', '0.99', 2],
  ['Krentebollen', '1.20', 4],
  ['Noten', '1.50', 0],
])

const headers = computed(() => ['Product', 'Prijs', 'Aantal', 'Subtotaal'])
</script>

<template>
  <GroceriesTable :headers="headers" :list="list" />
</template>

<style scoped></style>
