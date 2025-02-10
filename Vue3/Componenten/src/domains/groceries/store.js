import { computed, ref } from 'vue';

// State
const groceries = ref([
  { id: 1, name: 'Brood', price: '1.00', amount: 1 },
  { id: 2, name: 'Broccoli', price: '0.99', amount: 2 },
  { id: 3, name: 'Krentebollen', price: '1.20', amount: 4 },
  { id: 4, name: 'Noten', price: '1.50', amount: 0 },
]);

// Getters
export const getAllGroceries = computed(() => groceries.value);
export const getGroceryById = (id) => computed(() => groceries.value.find(grocery => grocery.id == id));

// Actions
export const addGrocery = (grocery) => groceries.value.push(grocery);
export const updateGrocery = (updatedGrocery) => {
  const index = groceries.value.findIndex(grocery => grocery.id === updatedGrocery.id);
  if (index !== -1) {
    groceries.value.splice(index, 1, updatedGrocery);
  }
};
export const deleteGrocery = (id) => groceries.value = groceries.value.filter(g => g.id != id);
