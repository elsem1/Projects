<script setup>
const props = defineProps({
  grocery: Object,

});

const emit = defineEmits(['submit']);

const submitForm = () => {
    emit('submit');
};
</script>

<template>
  <form @submit.prevent="submitForm">
    <div class="form">
      <label for="name">Name</label>
      <input id="name" type="text" placeholder="{{ props.grocery.name }}" required />
    </div>
    <div class="form">
      <label for="price">Price (€)</label>
      <input id="price" min="0" type="number" step="0.01" placeholder="{{ props.grocery.price }}" required />
    </div>
    <div class="form">
      <label for="amount">Amount</label>
      <input id="amount" min="0" type="number" placeholder="{{ props.grocery.amount }}" required />
    </div>

    <button type="submit">Save</button>
  </form>
</template>

<style scoped>
.form {
  margin-bottom: 5px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input {
  width: 20%;
  padding: 8px;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  padding: 5px 10px;
  font-size: 1rem;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}</style>
