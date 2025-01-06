<script setup>


import { ref, computed, nextTick } from 'vue'

const header = ref("Shopping List App")
const newItem = ref("")
const characterCount = computed(()=>
newItem.value.length)
const reversedItems = computed(()=>
[...items.value].reverse())
const editing = ref(false)
const newItemHighPriority = ref(false)
const items = ref([
    {
    id: 1, 
    label: "10 party hats", 
    purchased: true,
    highPriority: true,
    },
    {
    id: 2, 
    label: "2 board games",
    purchased: true,
    highPriority: false,      
    },
    
    {
    id: 3, 
    label: "20 cups",
    purchased: false,
    highPriority: false
    }
])
const saveItem = () =>
{
items.value.push(
    {
    id: items.value.length +1, 
    label: newItem.value,
    highPriority: newItemHighPriority.value,
    })
newItem.value=""
newItemHighPriority.value=""
} 
const itemInput = ref("")

const doEdit = async (e) => {
editing.value = e
newItem.value = ""
newItemHighPriority.value = ""

if (e) { 
    await nextTick()
    itemInput.value.focus()
}
}

const togglePurchased = (item) => 
{
item.purchased = !item.purchased
}
</script>

<template>
    <div class="header">
        <h1>{{ header }}</h1>  
        <button v-if="editing" class="btn btn-cancel" @click="doEdit(false)">
            Cancel
        </button>
        <button v-else class="btn btn-primary"  @click="doEdit(true)">
            Add Item
        </button>
    </div>
    <a v-bind:href="newItem">Dynamic Link</a>

    <form 
    class="add-item-form" 
    v-if="editing"  
    @submit.prevent="saveItem">
        <input v-model.trim="newItem" ref="itemInput" type="text" placeholder="Add an item..">  

        <p class="counter">{{characterCount}}/100</p>
        <label>
        <input type="checkbox" v-model="newItemHighPriority">High Priority
        </label> 
        <button  
            v-bind:disabled="newItem.length == 0"
            class="btn btn-primary"> 
            Save item
        </button> 
    </form>
    <ul>
        <li 
        v-for="(item, index) in reversedItems" 
        @click="togglePurchased(item)"
        :key="item.id"
        :class="{
            strikeout: item.purchased, 
            priority: item.highPriority
        }">
        {{item.label}}
        </li>
    </ul>
    <p v-if="!items.length">
        Noting to see here
    </p>
</template>
