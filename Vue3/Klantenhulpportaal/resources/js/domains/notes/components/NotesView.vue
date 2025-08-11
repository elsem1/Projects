<template>
    <div v-if="notes.length > 0" class="notes-view">
        <h3>Notities</h3>
        <table>
            <thead>
                <tr>
                    <th>Door</th>
                    <th>Geschreven op</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <template v-for="note in notesSortedByDate" :key="note.id">
                    <tr @click="toggleExpand(note.id)" class="note-row">
                        <td>{{ note.user?.name?.full_name || `${note.user?.name?.first_name} ${note.user?.name?.last_name}` }}</td>
                        <td>{{ formatDate(note.created_at) }}</td>
                        <td class="expand-indicator">
                            {{ expandedNoteId === note.id ? '▼' : '▶' }}
                        </td>
                    </tr>
                    <tr v-if="expandedNoteId === note.id" :key="`expanded-${note.id}`" class="note-content-row">
                        <td colspan="3" class="note-content">
                            <div class="note-content">
                            {{ note.content }}
                            </div>
                            <div class="note-action">
                                <RouterLink :to="{ name: 'notes.edit', params: { ticketId: $route.params.id, noteId: note.id } }" class="btn-edit">
                                Wijzig
                                </RouterLink>
                            </div>                           
                        </td>
                    </tr>
                    
                </template>
                <div class="note-create">
                    <RouterLink :to="{ name: 'notes.create', params: { ticketId: $route.params.id, } }" class="btn-create">
                    Niewe notitie toevoegen
                    </RouterLink>
                </div>
            </tbody>
        </table>
    </div>
    <div v-else class="no-notes">
        <p>Geen notities beschikbaar voor dit ticket.</p>
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

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleString('nl-NL', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit'
    });
};
</script>

<style scoped>
.notes-view {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #333;
}

.no-notes {
    padding: 1rem;
    font-family: Arial, sans-serif;
    color: #666;
    font-style: italic;
}

/* Tabel basisstijl */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    font-size: 0.9rem;
}

/* Headerstijl */
thead th {
    background-color: #f4f4f4;
    text-align: left;
    padding: 0.5rem 0.75rem;
    border-bottom: 2px solid #ddd;
}

/* Cell padding en border */
tbody td {
    padding: 0.5rem 0.75rem;
    border-bottom: 1px solid #eee;
}

/* Wisselende rij-kleur voor leesbaarheid */
tbody tr.note-row:nth-child(4n-3) {
    background-color: #fafafa;
}

/* Hover effect voor klikbare rijen */
tbody tr.note-row:hover {
    background-color: #f0f8ff;
    cursor: pointer;
}

/* Titel styling */
h3 {
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    display: block;
}

/* Note content styling */
.note-content-row {
    background-color: #f9f9f9 !important;
}

.note-content {
    background-color: #f9f9f9;
    padding: 1rem 0.75rem;
    white-space: wrap;
    font-size: 0.85rem;
    line-height: 1.4;
    border-left: 3px solid #ddd;
}

/* Expand indicator */
.expand-indicator {
    text-align: center;
    width: 30px;
    font-size: 0.8rem;
    color: #666;
}

.note-row .expand-indicator {
    transition: transform 0.2s ease;
}


.btn-create {
    
    background-color: #44d631;
    color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.btn:hover {
    filter: brightness(1.1);
    transform: translateY(-1px);
}


.btn:active {
    filter: brightness(0.9);
    transform: translateY(0);
}


.btn:focus {
    outline: 2px solid #80bfff;
    outline-offset: 2px;
}
.btn-edit {
    display: inline-block;
    padding: 0.4rem 0.8rem;
    font-family: Arial, sans-serif;
    font-size: 0.9rem;
    color: #fff;
    background-color: #007acc;
    /* Zachte blauwe kleur */
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.1s ease;
}

.btn-edit:hover {
    background-color: #005fa3;
    /* Donkerder blauw bij hover */
    transform: translateY(-1px);
}

.btn-edit:active {
    background-color: #004f8a;
    /* Nog donkerder bij klik */
    transform: translateY(0);
}

.btn-edit:focus {
    outline: 2px solid #80bfff;
    /* Subtiele focus ring */
    outline-offset: 2px;
}
</style>