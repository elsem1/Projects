<template>
  <InventoryTable :products="products" @removeProduct="removeProduct" />
</template>

<script setup>
import InventoryTable from '../components/InventoryTable.vue';
import { getAllProducts, modifyProduct } from '../store';

const products = getAllProducts;

const removeProduct = (productId) => {
  modifyProduct(productId);
};
</script>

