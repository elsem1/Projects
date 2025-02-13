<script setup lang="ts">
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import InventoryForm from '../components/InventoryForm.vue';
import { getProductById, modifyProduct } from '../store';

const route = useRoute();
const id = Number(route.params.id);
const product = getProductById(id)

const handleSubmit = (updatedProduct) => {
  modifyProduct(updatedProduct.id, updatedProduct);
    console.log(product.value.name + ' is updated.');
};
</script>

<template>
    <div class="edit">
        <h1>Edit Inventory Item</h1>
        <InventoryForm :product="product" @submit="handleSubmit" />
    </div>
</template>
