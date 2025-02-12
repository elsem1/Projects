import { computed, ref } from 'vue'

// State
const groceries = ref([
  { id: 1, name: 'Brood', price: 1.0, amount: 1 },
  { id: 2, name: 'Broccoli', price: 0.99, amount: 2 },
  { id: 3, name: 'Krentebollen', price: 1.2, amount: 4 },
  { id: 4, name: 'Noten', price: 1.5, amount: 0 },
])

// Getters
export const getAllGroceries = computed(() => groceries.value)
export const getGroceryById = (id) =>
  computed(() => groceries.value.find((grocery) => grocery.id == id)).value

// Actions
export const addGrocery = (grocery) => groceries.value.push(grocery)
export const updateGrocery = (updatedGrocery) => {
  const i = groceries.value.findIndex((grocery) => grocery.id === updatedGrocery.id)
  if (i !== -1) {
    groceries.value.splice(i, 1, updatedGrocery)
  }
}
export const deleteGrocery = (id) => (groceries.value = groceries.value.filter((g) => g.id != id))
