<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import { defineProps, onMounted, reactive, ref } from 'vue'
import { Head, Link, Inertia } from '@inertiajs/inertia-vue3';
import noresult from '../../../../public/images/no-results.png'
import ListElement from '../../Components/DemandeListElement.vue';


import DetailDemande from './DetailDemande.vue';

const props = defineProps({
    all_demandes: {},
    mes_demandes: {},

});


</script>
<template>
    <AppLayout title="Dashboard Admin">
        <div class=" overflow-y-auto  w-full mb-4 px-4 py-5 md:h-auto h-72">
            <span class="px-3 font-bold absolute  z-10 bg-dark text-white rounded-lg shadow-lg py-1 ">Mes
                    demandes
                </span>

            <div  v-if="mes_demandes!=null" class="md:w-1/2 mt-6">


                    <ul  v-for="demande,index in mes_demandes" class="" :key="index" >
                    <Link :href="route('details.demandes',demande.id)">
                    <ListElement :date="new Date(demande.created_at).toLocaleDateString()" :objet="demande.objet"
                        class="hover:scale-105 transition-all relative bg-gray-200 hover:z-20"
                        :auteur="demande.auteur" :status="demande.status" />
                    </Link>
                </ul>



            </div>

            <div v-else class=" grid grid-cols-1 md:grid-cols-2 place-items-center ml-6 mt-8">
                <div>   <h1 class=" text-2xl md:text-3xl   align-bottom "> Vous n'avez pas encore fait de demandes!🤔</h1></div>
                <div>  <img class="max-w-full w-2/3  cover  " src="../../../../public/images/no-results.png" alt="images pas de resultat">
</div>


            </div>
        </div>




    </AppLayout>
</template>
