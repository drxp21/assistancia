<script setup>
import {defineProps} from 'vue'
const props=defineProps({
    objet:'',
    date:'',
    auteur:''
})
</script>

<template>
    <div class="w-full  rounded-lg flex flex-wrap mt-2 pb-1">
        <span class="w-full h-1/6 px-3">
            <span class="text-xs bg-green-200 text-green-700 px-3  rounded-lg">{{ date }}</span>
        </span>
        <span class="w-full h-4/6 px-3 font-bold whitespace-nowrap overflow-hidden text-ellipsis">
{{ objet }}
        </span>
        <span class="w-full h-1/6 px-3 flex justify-end">
            <span class="text-xs px-3 bg-gray-200 text-gray-700 rounded-lg">par {{ auteur }}</span>
        </span>
    </div>
</template>
