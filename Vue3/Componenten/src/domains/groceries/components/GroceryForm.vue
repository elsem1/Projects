<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
const props = defineProps({
  grocery: Object,
})

const groceryCopy = ref({ ...props.grocery })
const emit = defineEmits(['submit'])
const router = useRouter()

const submitForm = () => {
  emit('submit', groceryCopy.value)
  router.push('/')
}
</script>

<template>
  <form @submit.prevent="submitForm">
    <div class="form">
      <label for="name">Name</label>
      <input id="name" type="text" v-model="groceryCopy.name" required />
    </div>
    <div class="form">
      <label for="price">Price (€)</label>
      <input id="price" min="0" type="number" step="0.01" v-model="groceryCopy.price" required />
    </div>
    <div class="form">
      <label for="amount">Amount</label>
      <input id="amount" min="0" type="number" v-model="groceryCopy.amount" required />
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
}
</style>
