<script setup>

import { ref } from 'vue'
import ChildComponent from './ChildComponent.vue';

const message = ref("Originele bericht van ouder");
const sharedMessage = ref("");


const handleMessage = (newMessage) => {
  message.value = newMessage;
};
</script>

<template>
  <ChildComponent :message="message" @updateMessage="handleMessage" v-model:message="sharedMessage"/>

  <p>Huidige bericht: {{ sharedMessage }}</p>
  


</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
