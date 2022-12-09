<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import SectionBorder from '@/Components/SectionBorder.vue';
import Banner from '@/Components/Banner.vue';

import { defineProps, onMounted, reactive, ref } from 'vue'
const props = defineProps({
    demande: {},


});
</script>

<template>
 <AppLayout title="Details demande" class="">
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200  mt-7 mx-5 rounded-md shadow-lg">
            Details de la demande
        </div>

      <div class="grid justify-items-center">

        <div class=" box-border p-10 mt-8 w-10/12 h-full rounded  bg-white ">





<span  class="w-full  px-3 flex justify-between  ">
    <span class="text-xs  bg-gray-700 text-white px-3  rounded-lg">{{new Date(demande.created_at).toLocaleDateString() }}</span>
     <span class="">

        <span v-if="demande.status == 'en_attente'"  class="text-xs bg-amber-200  px-4 py-2  rounded-lg"> {{demande.status}}</span>
        <span v-if="status == 'en_cours'"  class="text-xs bg-green-200 px-4 py-2  rounded-lg"> {{demande.status}}</span>
        <span v-if="status == 'traite'"  class="text-xs bg-green-600 px-4 py-2   rounded-lg"> {{demande.status}}</span>
        <span v-if="status == 'rejete'"  class="text-xs  bg-rose-600   px-4 py-2   rounded-lg"> {{demande.status}}</span>
     </span>



</span>
<br> <br>

<h1 class="text-3xl mt-6 underline" >{{demande.objet}}</h1>

<br> <br>

<p> {{demande.contenu}}</p>


</div>
      </div>



    </AppLayout>
</template>
<style>

</style>
