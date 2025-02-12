<script setup lang="ts">
import {ref} from 'vue';
import InventoryForm from '../components/InventoryForm.vue';
import {addProduct} from '../store';

const inventory = ref({
    id: null,
    name: '',
    actualAmount: 0,
    minimumAmount: 0,
});
const handleSubmit = newProduct => {
    newProduct.id = Date.now();
    addProduct(newProduct);
    Inventory.value = {id: null, name: '', actualAmount: 0, minimumAmount: 0};
};
</script>

<template>
    <div class="create">
        <h1>Create Inventory Item</h1>
        <InventoryForm :Inventory="Inventory" @submit="handleSubmit" />
    </div>
</template>
