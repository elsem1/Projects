<template>
  <div id="Vue3-Componenten">
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

  <h2>AboutView</h2>
  <label>
    Search: <input v-model.trim="search" maxlength="20">
  </label>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const router = useRouter()
const route = useRoute()

const props = defineProps({
  list: {
    type: Array,
    required: true,
  },
  headers: {
    type: Array,
    required: true,
  },
})

const search = computed({
  get() {
    return route.query.search ?? ''
  },
  set(search) {
    router.replace({ query: { search } })
  }
})

const calculateTotal = () => {
  let total = 0

  for (const item of props.list) {
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
