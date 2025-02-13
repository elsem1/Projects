<script setup lang="ts">
import { ref } from 'vue';
import InventoryForm from '../components/InventoryForm.vue';
import { addProduct, getAllProducts } from '../store';

const product = ref({
    id: null,
    name: '',
    actualAmount: 0,
    minimumAmount: 0,
});

const handleSubmit = (newProduct) => {
    newProduct.id = getAllProducts().length + 1;
    addProduct(newProduct);
    console.log(product.value.name + ' is created.');
    product.value = { id: null, name: '', actualAmount: 0, minimumAmount: 0 };

};
</script>

<template>
    <div class="create">
        <h1>Create Inventory Item</h1>
        <InventoryForm :product="product" @submit="handleSubmit" />
    </div>
</template>
