<script setup lang="ts">
import { ref } from 'vue';
import GroceryForm from '../components/GroceryForm.vue';
import { addGrocery } from '../store';

const grocery = ref({
  id: null,
  name: '',
  price: 0,
  amount: 0,
})
const handleSubmit = () => {
    grocery.value.id = Date.now();
    addGrocery(grocery.value);
    grocery.value = { id: null, name: '', amount: 0, price: 0 };
};

</script>

<template>
  <div class="create">
    <h1>Create Grocery Item</h1>
    <GroceryForm :grocery="grocery" @submit="handleSubmit" />
  </div>
</template>
