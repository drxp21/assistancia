<script setup>
import { defineProps } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import AppLayout from '../../Layouts/AppLayout.vue'
import ListElement from '../../Components/DemandeListElement.vue'


const props = defineProps({
    mes_demandes: {}
})
</script>
<template>
    <AppLayout title="Mes demandes">
        <div
            class="md:px-20 px-4 bg-white border-b border-gray-200  mt-7 mx-5 rounded-md shadow-lg flex flex-col md:flex-row flex-wrap gap-4 py-12">
            <h1 class="font-bold text-2xl text-center w-full">Mes demandes</h1>
            <ul v-if="mes_demandes.length" class="w-full">
                <li class="bg-dark mb-2 py-2 px-3 rounded-lg flex justify-around">

                    <span class="text-white font-bold text-center w-1/4 md:w-1/5  hidden md:block">Date</span>
                    <span class="text-white font-bold text-center w-1/4 md:w-1/5">Auteur</span>
                    <span
                        class="whitespace-nowrap overflow-hidden text-ellipsis text-white font-bold text-center w-1/4 md:w-1/5">Objet</span>
                    <span class="text-white font-bold text-center w-1/4 md:w-1/5">Status</span>
                    <span class="text-white font-bold text-center w-1/4 md:w-1/5">Consulter</span>

                </li>

                <li v-for="demande in mes_demandes" :key="demande" class="bg-gray-100 mb-2 rounded-lg flex justify-around">

                    <span
                        class="overflow-hidden text-ellipsis w-1/4 md:w-1/5 hidden md:block text-gray-400 py-3 text-center">
                        {{ new Date(demande.created_at).toLocaleDateString() }}
                    </span>

                    <span class="overflow-hidden text-xs text-gray-700 w-1/4 md:w-1/5 text-ellipsis text-center py-3 items-center flex justify-center">
                        {{ demande.auteur }}
                    </span>


                    <span
                        class="overflow-hidden text-ellipsis truncate text-center w-1/4 md:w-1/5  px-4 font-bold flex items-center py-3 hover:overflow-auto hover:z-10">
                        <span class="  hover:backdrop-blur-md">

                            {{ demande.objet }}
                        </span>
                    </span>

                    <span
                        class="text-center w-1/4 md:w-1/5 text-xs text-amber-400 font-bold  rounded-lg  flex items-center justify-center py-3"
                        v-if="
                        demande.status=='en_cours'">
                        En cours de traitement
                    </span>

                    <span
                        class="text-center w-1/4 md:w-1/5 text-xs text-green-500 font-bold  rounded-lg  flex items-center justify-center py-3"
                        v-if="demande.status=='traite'">
                        Traitée
                    </span>

                    <span
                        class="text-center w-1/4 md:w-1/5 text-xs text-red-700 font-bold  rounded-lg flex items-center justify-center py-3"
                        v-if="demande.status=='rejete'">
                        Rejetée
                    </span>

                    <span class="flex items-center py-3 w-1/4 md:w-1/5 justify-center" >
                        <Link class="px-2 md:px-4 py-1 text-sm text-indigo-600 bg-indigo-200 rounded-full" :href="route('admin.demande',demande.id)">

                            Consulter
                        </Link>
                    </span>
                </li>
            </ul>
            <div v-else class="flex flex-col md:flex-row items-center">
                <img :src="`/storage/assets/images/no-results.png`" alt="" class="w-56 h-26">
                <span class="font-semibold">
                    Vous ne prenez en charge aucune deamnde pour le moment
                </span>
            </div>
        </div>
    </AppLayout>
</template>
