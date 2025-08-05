<template>
    <div v-if="notes.length > 0" class="notes-view">
        <h3>Notities</h3>

        <table id="notes">
            <thead>
                <tr>
                    <th>Door</th>
                    <th>Geschreven op</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="note in notesSortedByDate" :key="note.id" @click="toggleExpand(note.id)"
                    style="cursor: pointer;">
                    <td>{{ note.user?.name }}</td>
                    <td>{{ note.created_at }}</td>
                </tr>

                <tr v-if="expandedNoteId">
                    <td>{{ getNoteContent(expandedNoteId) }}</td>
                </tr>

            </tbody>

        </table>

    </div>

</template>

<script setup lang="ts">
import { computed, ref } from 'vue';
import { Note } from '../types';
import { sortBy } from '../../../services/helpers/sortHelper';


const props = defineProps<{
    notes: Note[];
}>();

const expandedNoteId = ref<number | null>(null);

const notesSortedByDate = computed<Readonly<Note>[]>(() =>
    sortBy(
        props.notes,
        (n: Note) => n.created_at,
        false
    )
);

const toggleExpand = (id: number) => {
    expandedNoteId.value = expandedNoteId.value === id ? null : id;
};

const getNoteContent = (id: number) => {
    return notesSortedByDate.value.find(n => n.id === id)?.content || '';
};


</script>