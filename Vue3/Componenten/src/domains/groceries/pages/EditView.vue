<script setup lang="ts">
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import GroceryForm from '../components/GroceryForm.vue'
import { getGroceryById, updateGrocery } from '../store'

const route = useRoute()
const id = Number(route.params.id)
const grocery = computed(() => getGroceryById(id))

const handleSubmit = (updatedGrocery) => {
  updateGrocery(updatedGrocery)
  console.log(grocery.value.name + ' is updated.')
}
</script>

<template>
  <div class="edit">
    <h1>Edit Grocery Item</h1>
    <GroceryForm :grocery="grocery" @submit="handleSubmit" />
  </div>
</template>
