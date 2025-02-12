<script setup lang="ts">
import {computed} from 'vue';
import {useRoute} from 'vue-router';
import InventoryForm from '../components/InventoryForm.vue';
import {getProducctById, updateProduct} from '../store';

const route = useRoute();
const id = Number(route.params.id);
const product = computed(() => getInventoryById(id));

const handleSubmit = updatedInventory => {
    updateInventory(updatedInventory);
    console.log(inventory.value.name + ' is updated.');
};
</script>

<template>
    <div class="edit">
        <h1>Edit Inventory Item</h1>
        <InventoryForm :inventory="inventory" @submit="handleSubmit" />
    </div>
</template>
