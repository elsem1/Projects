<script setup>
import {ref} from 'vue';
import {useRouter} from 'vue-router';
const props = defineProps({
  product: Object,
  isCreatePage: Boolean,
  isEditPage: Boolean,
});


const productCopy = ref({...props.product});
const emit = defineEmits(['submit']);
const router = useRouter();

const submitForm = () => {
  if (props.isCreatePage) {
    emit('submit', productCopy.value);
  } else if (props.isEditPage) {
    emit('submit', productCopy.value);
  }
  router.push('/');
};

</script>

<template>
    <form @submit.prevent="submitForm">
        <div class="form">
            <label for="name">Name</label>
            <input id="name" type="text" v-model="productCopy.name" required />
        </div>
        <div class="form" v-if="productCopy.id === null">
            <label for="price">Actual Amount</label>
            <input id="price" min="0" type="number" step="1" v-model="productCopy.actualAmount" />
        </div>
        <div class="form">
            <label for="amount">Minimum Amount</label>
            <input id="amount" min="0" type="number" step="1" v-model="productCopy.minimumAmount" required />
        </div>
        <button class="cancel" @click="router.push('/')">Annuleren</button>
        <button v-if="productCopy.id === null" class="submit">Toevoegen</button>
        <button v-if="productCopy.id !== null" class="submit">Aanpassen</button>
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
.cancel {
  background-color: #f03c3c;
}
.cancel:hover {
    background-color: #942e2e;
}
</style>
