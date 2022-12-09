<script setup>
import {defineProps} from 'vue'
const props=defineProps({
    objet:'',
    date:'',
    auteur:'',
    status :'',
})
</script>

<template>
    <div class="w-full  rounded-lg flex flex-wrap mt-2 pb-1">
        <span  class="w-full h-1/6 px-3 flex justify-between  ">
            <span class="text-xs  bg-gray-700 text-white px-3  rounded-lg">{{ date }}</span>
             <span>

                <span v-if="status == 'en_attente'"  class="text-xs bg-amber-200  px-3  rounded-lg"> {{status}}</span>
                <span v-if="status == 'en_cours'"  class="text-xs bg-green-200  px-3  rounded-lg"> {{status}}</span>
                <span v-if="status == 'traite'"  class="text-xs bg-green-600  px-3  rounded-lg"> {{status}}</span>
                <span v-if="status == 'rejete'"  class="text-xs  bg-rose-600   px-3  rounded-lg"> {{status}}</span>
             </span>


        </span>
        <span class="w-full h-4/6 px-3 font-bold whitespace-nowrap overflow-hidden text-ellipsis">
{{ objet }}
        </span>
        <!-- <span class="w-full h-1/6 px-3 flex justify-end">
            <span class="text-xs px-3 bg-gray-200 text-gray-700 rounded-lg"> {{ auteur }}</span>
        </span> -->
    </div>

</template>
