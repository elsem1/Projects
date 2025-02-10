<template>
  <div id="Boodschappenlijst">
    <table>
      <thead>
        <tr>
          <th v-for="header in Object.keys(groceries[0]).filter(k => k !== 'id')" :key="header">
            {{ header.charAt(0).toUpperCase() + header.slice(1) }}
          </th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in groceries" :key="item.id">
          <td v-for="(value, key) in item" :key="key" v-show="!['id'].includes(key)">
            <input
              v-if="key === 'amount'"
              type="number"
              v-model.number="item[key]"
            />
            <template v-else-if="key === 'price'">
              € {{ Number(value).toFixed(2) }}
            </template>
            <template v-else-if="key === 'name'">{{ value }}</template>
          </td>
          <td>
            € {{ (item.price * item.amount).toFixed(2) }}
          </td>
        </tr>
        <tr>
          <td colspan="3">Totaal</td>
          <td>€ {{ calculateTotal }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { getAllGroceries } from '../store';

const groceries = getAllGroceries;

const calculateTotal = computed(() => groceries.value.reduce((acc, item) => acc += item.amount * item.price, 0).toFixed(2))

// const calculateTotal = () => {
//   let total = 0
//   if (groceries.value) {
//     for (const grocery of groceries.value) {
//       const price = Number(grocery.price ?? 0)
//       const quantity = (grocery.amount ?? 0)
//       total += price * quantity
//     }
//   }
//   return total.toFixed(2)
// }
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
