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



var data = reactive({
    labels: [
        'Traitées',
        'En cours',
        'Rejetées'
    ],
    datasets: [{
        data: [],
        backgroundColor: ['#036e15', '#6875F5', '#bf0702'],
        hoverOffset: 4
    }]
});
onMounted(() => {
    let id = usePage().props.value.user.id
    axios.get(route('one', id)).then(res => data.datasets[0].data = (res.data)).catch(err => console.log(err))
})
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








const props = defineProps({
    user: {},

})

</script>
<template>
    <AppLayout title="Dashboard Admin" :lien="id">
        <div class=" p-6 flex flex-col items-center h-32rem mx-5 border-b border-gray-200  sm:px-20 rounded-md  bg-white mt-5    " id="admin">
                <div class="grid grid-cols-3 md:grid-cols-3 md:gap-8 lg:grid-cols-3 gap-10  ">
                    <div class="grid lg:grid-cols-3 lg:gap-10 mt-12 ">
                        <div class="flex flex-col">
                            <strong class=" md:text-2xl font-extrabold">{{ data.datasets[0].data[0] }}</strong>
                            <span class="w-full">
                                 Traitées
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <strong class=" md:text-2xl font-extrabold">{{ data.datasets[0].data[1] }}</strong>
                            <span class="w-full">
                                 en cours
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <strong class=" md:text-2xl font-extrabold">{{ data.datasets[0].data[2] }}</strong>
                            <span class="w-full">
                                 Rejetées
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <img :src="user.profile_photo_url" alt="photo" class="h-24 w-24 md:h-40 md:w-40 object-cover rounded-full ">
                    </div>
                    <div class="mt-16 font-extrabold uppercase text-xs lg:text-2xl">
                        Profil admin
                    </div>
                </div>
                <div class="flex flex-col  mt-3 mr-20 ">
                    <div class="text-4xl lg:text-7xl font-extrabold">
                        {{user.name}}
                    </div>
                </div>
                <div class="flex flex-col text-gray-500 mt-4 mr-10 text-xl">
                    {{user.email}}
                </div>
                <div class="flex items-center text-gray-500 mt-4 mr-10 text-xl">
                    <button @click="DetailsPage" class="flex items-center bg-primary text-white font-bold text-xl p-4 rounded-full mt-4">
                        voir
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>

            </div>
            <div class=" fixed top-0 left-0 right-0 bottom-0 bg-black bg-opacity-60  z-2 h-screen" v-if="autre" @click="CloseDrop">
            <div class=" p-12 flex flex-col w-[13rem] sm:w-[20rem] lg:w-[32rem] items-center mx-28 sm:mx-64  lg:mx-96  border-b border-gray-200  sm:px-20 rounded-md relative justify-center bg-white shadow-2xl   mt-10 " id="admin">
                <div class="flex flex-col items-center capitalize  text-2xl font-bold" v-if="data.datasets[0].data.length">

                        <Doughnut :chartData="data" :chart-options="ChartOptions" :width="300" :height="200"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, registerables } from 'chart.js'

ChartJS.register(...registerables)
   export default {
    data(){
        return{
            autre:false,



        }
    },
    components: { Doughnut },
    methods:{
        DetailsPage(){
            this.autre = !this.autre;
        },
        CloseDrop()
        {
            this.autre = false;
        }
    }


   }
</script>
