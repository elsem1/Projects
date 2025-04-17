<template>
    <div v-for="error in getErrorByProperty(name).value" :key="error">
        <p style="color:red">{{ error }}</p>
    </div>
</template>

<script setup lang="ts">
import { getErrorByProperty } from '../error';

const {name} = defineProps<{ name: string }>();
</script>