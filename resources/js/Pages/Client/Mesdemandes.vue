<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import { defineProps, onMounted, reactive, ref } from 'vue'
import { Head, Link, Inertia } from '@inertiajs/inertia-vue3';
import noresult from '../../../../public/images/no-results.png'
import ListElement from '../../Components/DemandeListElement_client.vue';
import ListElement2 from '../../Components/DemandeListElement.vue';


import DetailDemande from './DetailDemande.vue';

const props = defineProps({
    all_demandes: {},
    mes_demandes: {},

});


</script>
<template>
    <AppLayout title="Dashboard client">
        <div class="p-6 sm:px-20 bg-dark text-white border-b border-gray-200  mt-7 mx-5 rounded-md shadow-lg">
            Historiques de vos demandes
        </div>



        <div class="   grid grid-cols-1 place-items-center md:ml-6  ">



            <div
                class="md:px-10 sm:px-20 border-b border-gray-200  mt-7  rounded-md shadow-lg flex flex-col md:flex-row flex-wrap gap-4 py-1 ">


                <div v-if="mes_demandes.length" class=" p-10 mt-2 h-5/6 rounded  ">


                    <ul v-for="demande, index in mes_demandes" class="" :key="index">
                        <Link :href="route('details.demandes', demande.id)">
                        <ListElement :date="new Date(demande.created_at).toLocaleDateString()" :objet="demande.objet"
                            class="hover:scale-105 transition-all relative bg-gray-200 hover:z-20"
                            :auteur="demande.auteur" :status="demande.status" />
                        </Link>
                    </ul>



                </div>

                <div v-else class=" grid  md:grid-cols-2 place-items-center ml-6 mt-8">
                    <div>
                        <h1 class=" text-2xl md:text-3xl   align-bottom "> Vous n'avez pas encore fait de demandes!🤔
                        </h1>
                    </div>
                    <div> <img class="max-w-full w-2/3  cover  " src="../../../../public/images/no-results.png"
                            alt="images pas de resultat">
                    </div>
                </div>
            </div>
        </div>




    </AppLayout>
</template>
