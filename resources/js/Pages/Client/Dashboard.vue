<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import { defineProps, onMounted, reactive, ref } from 'vue'
import { Head, Link, Inertia } from '@inertiajs/inertia-vue3';
import noresult from '../../../../public/images/no-results.png'
import ListElement from '../../Components/DemandeListElement_client.vue';


import DetailDemande from './DetailDemande.vue';

const props = defineProps({
    all_demandes: {},
    mes_demandes: {},

});


</script>
<template>
    <AppLayout title="Dashboard client">
        <div class="p-12  sm:px-20 text-black border-b border-gray-200  mt-7 mx-5 rounded-md shadow-2xl bg-gray" >
            <div class="flex items-center text-3xl lg:text-5xl font-bold">
                <h1>Bienvenue {{$page.props.user.name}}</h1>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mx-4">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 01.198-.471 1.575 1.575 0 10-2.228-2.228 3.818 3.818 0 00-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0116.35 15m.002 0h-.002" />
                </svg>


            </div>
            <div class="mt-3 text-2xl">Ici vous trouverez les infos relatives a vos demandes .</div>
        </div>

        <div class=" overflow-y-auto  w-full mb-4 px-4 py-5 md:h-auto h-72">
            <span class="px-3 font-bold absolute  z-10 bg-dark text-white rounded-lg shadow-lg py-1 ">Mes
                    demandes
                </span>

                <div class="grid justify-items-center">


            <div  v-if="mes_demandes!=null" class="box-border p-10 mt-8 w-10/12 h-full rounded  bg-white">


                    <ul  v-for="demande,index in mes_demandes" class="" :key="index" >
                    <Link :href="route('details.demandes',demande.id)">
                    <ListElement :date="new Date(demande.created_at).toLocaleDateString()" :objet="demande.objet"
                        class="hover:scale-105 transition-all relative bg-gray-200 hover:z-20"
                        :auteur="demande.auteur" :status="demande.status" />
                    </Link>
                </ul>



            </div>

            <div v-else class=" grid  md:grid-cols-2 place-items-center ml-6 mt-8">
                <div>   <h1 class=" text-2xl md:text-3xl   align-bottom "> Vous n'avez pas encore fait de demandes!🤔</h1></div>
                <div>  <img class="max-w-full w-2/3  cover  " src="../../../../public/images/no-results.png" alt="images pas de resultat">
</div>


</div>
            </div>
        </div>




    </AppLayout>
</template>
