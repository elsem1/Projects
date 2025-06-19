<template>
    <div v-if="getMessage">
        <p style="color:red">{{ getMessage }}</p>
    </div>
</template>

<script setup lang="ts">
import { getMessage } from "./index.ts";
</script>