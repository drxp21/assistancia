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
            class="md:px-20 sm:px-20 bg-white border-b border-gray-200  mt-7 mx-5 rounded-md shadow-lg flex flex-col md:flex-row flex-wrap gap-4 py-12">
<<<<<<< HEAD
            <h1 class="font-bold text-2xl text-center">Mes demandes</h1>
            <ul v-if="mes_demandes.length" class="w-full">
                <li class="bg-gray-600 mb-2 py-5 px-3 rounded-lg flex justify-around">

                    <span class="text-white font-bold px-4 hidden md:block">Date</span>
                    <span class="text-white font-bold px-4">Auteur</span>
                    <span class="whitespace-nowrap overflow-hidden text-ellipsis text-white font-bold px-4">Objet</span>
                    <span class="text-white font-bold px-4">Status</span>
                    <span class="text-white font-bold px-4">Consulter</span>

                </li>

                <li v-for="demande,index in mes_demandes" :key="index" class="bg-gray-200 mb-2 py-5 px-3 rounded-lg flex justify-around">
                    <span class="overflow-hidden text-start w-1/4 md:w-1/5 text-ellipsis px-4 hidden md:block">{{ new Date(demande.created_at).toLocaleDateString() }}</span>
                    <span class="overflow-hidden text-start w-1/4 md:w-1/5 text-ellipsis px-4">{{ demande.auteur }}</span>
                    <span class="whitespace-nowrap overflow-hidden text-start w-1/4 md:w-1/5 text-ellipsis px-4">{{ demande.objet }}</span>
                    <span class="overflow-hidden text-start w-1/4 md:w-1/5 text-ellipsis px-4">{{ demande.status }}</span>
                    <Link class="overflow-hidden text-start w-1/4 md:w-1/5 text-ellipsis px-4 py-1 text-sm text-indigo-600 bg-indigo-200 rounded-full h-9">Consulter</Link>
=======
            <h1 class="font-bold text-2xl text-center w-full">Mes demandes</h1>
            <ul v-if="mes_demandes.length" class="w-full">
                <li class="bg-dark mb-2 py-2 px-3 rounded-lg flex justify-around">

                    <span class="text-white font-bold text-center  hidden md:block">Date</span>
                    <span class="text-white font-bold text-center ">Auteur</span>
                    <span class="whitespace-nowrap overflow-hidden text-ellipsis text-white font-bold text-center ">Objet</span>
                    <span class="text-white font-bold text-center ">Status</span>
                    <span class="text-white font-bold text-center ">Consulter</span>

                </li>

                <li v-for="demande in mes_demandes" class="bg-gray-200 mb-1 py- px-3 rounded-lg flex justify-around">
                    <span class="overflow-hidden w-1/4 md:w-1/5 text-ellipsis px-4 hidden md:block text-gray-400 py-3">
                        {{ new Date(demande.created_at).toLocaleDateString() }}
                    </span>
                    <span class="overflow-hidden text-start text-xs text-gray-700 w-1/4 md:w-1/5 text-ellipsis px-4 py-3">
                        {{ demande.auteur }}
                    </span>


                    <span class="whitespace-nowrap overflow-hidden text-start w-1/4 md:w-1/5 text-ellipsis px-4 font-bold flex items-center py-3">
                        {{ demande.objet }}
                    </span>
                    <span class="text-start w-1/4 md:w-1/5 text-xs text-amber-600 font-bold  rounded-lg  flex items-center py-3" v-if="
                    demande.status=='en_cours'">
                        En cours de traitement
                    </span>
                    <span class="text-start w-1/4 md:w-1/5 text-xs text-green-700 font-bold  rounded-lg  flex items-center py-3"
                        v-if="demande.status=='traite'">
                        Traitée
                    </span>
                    <span class="text-start w-1/4 md:w-1/5 text-xs text-red-700 font-bold  rounded-lg flex items-center py-3"
                        v-if="demande.status=='rejete'">
                        Rejetée
                    </span>
                    <Link class="flex items-center py-3" :href="route('admin.demande',demande.id)">
                    Consulter
                    </Link>
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
                </li>
            </ul>
            <div v-else>
                pas de demandes insbi
            </div>
        </div>
    </AppLayout>
</template>
