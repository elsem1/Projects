<script setup lang="ts">
import InventoryOverview from '../pages/InventoryOverview.vue';
import { getAllProducts } from '../store';

const toOrder = () => {
  const products = getAllProducts();
  const orderList = [];

  for (let i = 0; i < products.length; i++) {
    if (products[i].actualAmount < products[i].minimumAmount) {
      const difference = products[i].minimumAmount - products[i].actualAmount;
      orderList.push({
        product: products[i],
        difference: difference
      });
    }
  }

  return orderList;
};
const orderList = toOrder();

</script>

<template>
  <div class="order">
      <h1>Bestel Pagina</h1>
      <InventoryOverview />
  </div>
</template>
