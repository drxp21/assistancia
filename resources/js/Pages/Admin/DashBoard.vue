<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3'
import { defineProps, onMounted, reactive, ref } from 'vue'
import axios from 'axios'
import AppLayout from '../../Layouts/AppLayout.vue'
import ListElement from '../../Components/DemandeListElement.vue'
import { Chart as ChartJS, registerables } from 'chart.js'
import Dropdown from '../../Components/Dropdown.vue'
import { Doughnut } from 'vue-chartjs'
ChartJS.register(...registerables)
var periode = ref('')

const props = defineProps({
    all_demandes: {},
    mes_demandes: {},
})

var data = reactive({
    labels: [
        'Traitées',
        'En cours',
        'Rejetées'
    ],
    datasets: [{
        data: [],
        backgroundColor: ['#875f5f', '#b88c8c', '#593535'],
        hoverOffset: 4
    }]
});

const ChartOptions = {
    responsive: true,
    plugins: {
        title: {
            display: true,
            text: 'Statistiques',
            position: 'bottom'
        }
    }
}

onMounted(() => {
    let id = usePage().props.value.user.id
    axios.get(route('stats', [id, 'all'])).then(res => data.datasets[0].data = (res.data)).catch(err => console.log(err))
})

const period = () => {
    let id = usePage().props.value.user.id
    axios.get(route('stats', [id, periode.value])).then(res => data.datasets[0].data = (res.data)).catch(err => console.log(err))
}

</script>
<template>



    <AppLayout title="Dashboard Admin">
        <div
            class="md:px-20 sm:px-20 bg-white border-b border-gray-200  mt-7 mx-5 rounded-md shadow-lg flex flex-col md:flex-row flex-wrap gap-4 py-12">
            <span class="w-full text-center h-[5%] ">
                <h1 class="font-bold text-2xl my-3">Mes statistiques</h1>

                <select name="periode" @change="period" v-model="periode"
                    class="border-gray-300 focus:border-primary focus:ring focus:ring-light focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="all">Toutes</option>
                    <option value="monthly">Ce mois ci</option>
                    <option value="weekly">Cette semaine</option>
                    <option value="daily">Aujourd'hui</option>
                </select>
            </span>
            <div class="flex-[2] md:h-[95%] h-[45%] md:w-7 w-full" v-if="data.datasets[0].data.length">
                <Doughnut :chartData="data" :chart-options="ChartOptions" />
            </div>
            <div class="flex flex-wrap animate-pulse items-center justify-center flex-[2] md:h-[95%] h-[45%] md:w-7 w-full"
                v-else>
                <div class="w-96 my-3  h-6 rounded-md flex justify-between">
                    <div class="bg-gray-300 w-16 rounded-md shadow-lg">

                    </div>
                    <div class="bg-gray-300 w-16 rounded-md shadow-lg">

                    </div>
                    <div class="bg-gray-300 w-16 rounded-md shadow-lg">

                    </div>
                </div>
                <div class="w-72 bg-gray-300 h-72 rounded-full ">
                </div>
                <div class="w-44 my-3 bg-gray-300 h-6 rounded-md shadow-lg ">
                </div>
            </div>

            <div class="flex-[3] md:h-[95%] h-[45%]  gap-4 flex md:flex-wrap md:p-12 md:justify-end justify-center sm:px-0"
                v-if="data.datasets[0].data.length">

                <Link :href="route('admin.demandes')"
                    class="flex flex-wrap shadow-lg rounded-md border-l-8 border-l-primary md:p-5 p-3 md:w-1/3 hover:scale-105 transition-all">
                <span class="w-full">
                    Traitées
                </span>
                <span class="w-full">
                    <strong class="text-3xl">{{ data.datasets[0].data[0] }}</strong>
                </span>

                </Link>
                <Link :href="route('admin.demandes')"
                    class="flex flex-wrap shadow-lg rounded-md border-l-8 border-l-light md:p-5 p-3 md:w-1/3 hover:scale-105 transition-all">

                    <span class="w-full">
                    En cours
                </span>

                <span class="w-full">
                    <strong class="text-3xl"> {{ data.datasets[0].data[1]}} </strong>

                </span>

            </Link>

            <Link :href="route('admin.demandes')"
                    class="flex flex-wrap shadow-lg rounded-md border-l-8 border-l-dark md:p-5 p-3 md:w-1/3 hover:scale-105 transition-all">
                <span class="w-full">
                    Rejetées
                </span>
                <span class="w-full">
                    <strong class="text-3xl"> {{ data.datasets[0].data[2]}} </strong>

                </span>

            </Link>
            </div>



            <div class="flex-[3] md:h-[95%] h-[45%]  gap-4 flex md:flex-wrap md:p-12 md:justify-end justify-center sm:px-0 animate-pulse"
                v-else>
                <div class="flex flex-wrap shadow-lg rounded-md bg-gray-300 md:p-5 p-3 md:w-1/3 w-1/4 h-20"></div>
                <div class="flex flex-wrap shadow-lg rounded-md bg-gray-300 md:p-5 p-3 md:w-1/3 w-1/4 h-20"></div>
                <div class="flex flex-wrap shadow-lg rounded-md bg-gray-300 md:p-5 p-3 md:w-1/3 w-1/4 h-20"></div>
            </div>
        </div>
        <div
            class="p-6 sm:px-20 bg-white border-b border-gray-200  mt-7 mx-5 rounded-md shadow-lg flex flex-wrap md:flex-nowrap gap-4 md:h-96 relative">


            <div class="md:w-1/2 overflow-y-auto  h-72 md:h-auto w-full mb-4 px-4  py-5">
                <Link class="px-3 font-bold absolute  z-10 bg-dark text-white rounded-lg shadow-lg py-1 " >
                    Demandes non traitées
                </Link >
                <ul v-if="all_demandes.length">
                    <Link v-for="demande in all_demandes" :key="demande.id" :href="route('admin.demande',demande.id)">
                    <ListElement :date="new Date(demande.created_at).toLocaleDateString()" :objet="demande.objet"
                        :status="demande.status" class="
                         relative bg-gray-100 hover:z-20"
                        :auteur="demande.auteur" />
                    </Link>
                </ul>
                <div class="flex py-5 justify-center items-center flex-col-reverse md:flex-row" v-else>
                    <span class="font-bold">Aucune demande non traitée</span>
                    <img :src="`/storage/assets/images/emptyFolder.webp`" class="w-1/2 h-1/2" alt="">
                </div>
            </div>

            <div class="md:w-1/2 overflow-y-auto  h-72 md:h-auto w-full mb-4 px-4 py-5">
                <Link class="px-3 font-bold absolute  z-10 bg-light text-white rounded-lg shadow-lg py-1 " :href="route('admin.demandes')" >Mes
                    demandes
                </Link>
                <ul v-if="mes_demandes.length">
                    <Link v-for="demande in mes_demandes"  :key="demande.id" class="" :href="route('admin.demande',demande.id)">
                    <ListElement :date="new Date(demande.created_at).toLocaleDateString()" :objet="demande.objet"
                        :status="demande.status" class="hover:scale-105 transition-all relative bg-gray-200 hover:z-20"
                        :auteur="demande.auteur" />
                    </Link>
                </ul>
                <div class="flex py-5 justify-center items-center flex-col-reverse md:flex-row" v-else>
                    <img :src="`/storage/assets/images/emptyFolder.webp`" class="w-1/2 h-1/2" alt="">
                    <span class="font-bold">Vous n'avez aucune demande</span>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
