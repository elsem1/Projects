<template>
  <div id="Vue3-Boodschappenlijst">
    <table>
      <thead>
        <tr>
          <th v-for="(header, index) in headers" :key="index">
            {{ header }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in list" :key="index">
          <td v-for="(value, index) in item" :key="index">
            <input v-if="index === 2" type="number" v-model="item[index]" />
            <span v-else>{{ value }}</span>
          </td>
          <td class="subtotal">{{ (item[1] * item[2]).toFixed(2) }}</td>
        </tr>
        <tr>
          <td colspan="3">Totaal</td>
          <td>{{ calculateTotal() }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const list = ref([
  ['Brood', '1.00', 1],
  ['Broccoli', '0.99', 2],
  ['Krentebollen', '1.20', 4],
  ['Noten', '1.50', 0],
])

const headers = computed(() => ['Product', 'Prijs', 'Aantal', 'Subtotaal'])

const calculateTotal = () => {
  let total = 0

  for (const item of list.value) {
    const price = Number(item[1])
    const quantity = Number(item[2])
    total += price * quantity
  }
  return total.toFixed(2)
}
</script>

<style scoped>
header {
  line-height: 1.5;
}
#app {
  font-family: 'Arial', sans-serif;
  padding: 20px;
  background-color: #363434d3;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th,
td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
  min-width: 100px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

th {
  background-color: #4caf50;
  color: white;
}
</style>
