<template>
  <div class="order">
      <h1>Bestel Pagina</h1>
      <InventoryTable :products="orderList" :isOrderPage="true" />
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import InventoryTable from '../components/InventoryTable.vue';
import { getAllProducts } from '../store';


const products = getAllProducts;

const orderList = computed(() => {
  return products.value
    .filter(product => product.actualAmount < product.minimumAmount)
    .map(product => {
      const difference = product.minimumAmount - product.actualAmount;

      return { name: product.name, difference };
    });
});
</script>
