<script setup>
    import { ref } from 'vue'

    defineProps({
        message: String,
    });

    const emit = defineEmits(['updateMessage']);

    const emitEvent = () => {
    emit('updateMessage', 'Nieuw bericht van het kind');
    };

    const message2 = defineModel();
</script>

<template>
    <div>
        <h3>{{ message }}</h3>
    </div>
    <div>
        <button @click="emitEvent">Verzend Bericht</button>
    </div>
    <div>
        <input v-model="message2" placeholder="Type something here.." />
    </div>

</template>


