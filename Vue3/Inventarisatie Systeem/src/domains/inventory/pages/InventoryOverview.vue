<template>
    <div id="Inventarisatie Systeem">
        <table>
            <thead>
                <tr>
                    <th v-for="header in Object.keys(products[0]).filter(k => k !== 'id')" :key="header">
                        {{ header.charAt(0).toUpperCase() + header.slice(1) }}
                    </th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in products" :key="item.id">
                    <td v-for="(value, key) in item" :key="key" v-show="!['id'].includes(key)">
                        <template v-if="key === 'name'">
                            {{ value }}
                            <RouterLink class="edit-button" :to="`/edit/${item.id}`">Edit</RouterLink>
                            <button class="delete-button" @click="removeProduct(item.id)">Delete</button>
                        </template>
                        <input v-else-if="key === 'actualAmount'" type="number" v-model.number="item[key]" />
                        <template v-else-if="key === 'minimumAmount'">{{ value }}</template>
                    </td>
                </tr>
                <tr></tr>
            </tbody>
        </table>
    </div>
</template>
<script setup>
import {computed} from 'vue';
import {getAllProducts, deleteProduct} from '../store';

const products = getAllProducts;

const calculateTotal = computed(() =>
    inventory.value.reduce((acc, item) => (acc += item.amount * item.price), 0).toFixed(2),
);

const removeProduct = ProductId => {
    deleteProduct(ProductId);
};
</script>

<style scoped>
header {
    line-height: 1.5;
}
#app {
    font-family: 'Arial', sans-serif;
    padding: 20px;
    background-color: #363434d3;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th,
td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
    min-width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    position: relative;
}

th {
    background-color: #4caf50;
    color: white;
}
.edit-button {
    position: absolute;
    right: 5rem;
    bottom: 0.35rem;
    padding: 3px 6px;
    font-size: 1rem;
    background-color: #ffa53d;
    border: 0;
    border-radius: 4px;
    box-shadow: rgba(0, 0, 0, 0.1) 0 2px 4px;
    display: inline-block;
    font-family:
        Inter,
        -apple-system,
        system-ui,
        Roboto,
        'Helvetica Neue',
        Arial,
        sans-serif;
    transition: box-shadow 0.2s;
    cursor: pointer;
}

.edit-button:hover {
    background-color: #eb7d00;
}
.delete-button {
    position: absolute;
    right: 0.5rem;
    bottom: 0.35rem;
    padding: 3px 6px;
    font-size: 1rem;
    background-color: #f03c3c;
    border: 0;
    border-radius: 4px;
    box-shadow: rgba(0, 0, 0, 0.1) 0 2px 4px;
    display: inline-block;
    font-family:
        Inter,
        -apple-system,
        system-ui,
        Roboto,
        'Helvetica Neue',
        Arial,
        sans-serif;
    transition: box-shadow 0.2s;
    cursor: pointer;
}

.delete-button:hover {
    background-color: #942e2e;
}
</style>
