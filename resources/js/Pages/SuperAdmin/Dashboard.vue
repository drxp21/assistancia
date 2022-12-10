<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { ref,computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios'
import { Head, Link } from '@inertiajs/inertia-vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { defineProps, onMounted, reactive } from 'vue'
import { Chart as ChartJS, registerables } from 'chart.js'
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
    axios.get(route('all', )).then(res => data.datasets[0].data = (res.data)).catch(err => console.log(err))
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


var form = useForm({
    name: '',
    email:'',
    photo:null
})

const Changer = (e) =>
{
    console.log("selected file", e.target.files[0])
    form.photo = e.target.files[0];
}

const add = () => {
    form.post(route('new.admin')
    )
}







const props = defineProps({
    users: {},

})

</script>
<template>
    <AppLayout title="Dashboard Admin" :lien="id">
        <div class="p-12  sm:px-20 text-black border-b border-gray-200  mt-7 mx-5 rounded-md shadow-2xl bg-gray" >
            <div class="flex items-center text-3xl lg:text-5xl font-bold">
                <h1>Bienvenue {{$page.props.user.name}}</h1>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mx-4">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 01.198-.471 1.575 1.575 0 10-2.228-2.228 3.818 3.818 0 00-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0116.35 15m.002 0h-.002" />
                </svg>


            </div>
            <div class="mt-3 text-2xl">Ici vous trouverez les infos relatives a l'entreprise.</div>
        </div>
        <!-- les stats -->

        <div class=" p-12 flex flex-col items-center mx-5 border-b border-gray-200  sm:px-20 relative justify-center bg-white shadow-2xl   mt-5 " id="stat" >
            <div class="flex flex-col items-center uppercase p-6 mb-6  text-xl font-extrabold">
                les statistiques de l'entreprise.
            </div>
            <div class="grid grid-cols-1     lg:grid-cols-2" v-if="data.datasets[0].data.length">
                <Doughnut :chartData="data" :chart-options="ChartOptions" />



            <div class="flex-[3] md:h-[95%] h-[45%]  gap-4 flex md:flex-wrap md:p-12 md:justify-end justify-center  sm:px-0"
                v-if="data.datasets[0].data.length">
                <Link
                    class="flex flex-wrap shadow-lg rounded-md border-l-8 border-l-[#036e15] md:p-5 p-3 md:w-screen  hover:scale-105 transition-all">
                <span class="text-xs lg:text-xl">
                    Traitées
                </span>
                <span class="w-full mt-2">
                    <strong class="text-3xl ">{{ data.datasets[0].data[0] }}</strong>
                </span>
                </Link>
                <Link
                    class="flex flex-wrap sm: shadow-lg rounded-md border-l-8 border-l-[#6875F5] md:p-5 p-3 md:w-screen hover:scale-105 transition-all">
                <span class="w-full text-xs lg:text-xl">
                    En cours
                </span>
                <span class="w-full mt-2">
                    <strong class="text-3xl "> {{ data.datasets[0].data[1]}} </strong>

                </span>
                </Link>
                <Link
                    class="flex flex-wrap shadow-lg rounded-md border-l-8 border-l-[#bf0702] md:p-5 p-3 md:w-screen hover:scale-105 transition-all">
                <span class="w-full text-xs lg:text-xl">
                    Rejetées
                </span>
                <span class="w-full mt-2">
                    <strong class="text-3xl"> {{ data.datasets[0].data[2]}} </strong>

                </span>
                </Link>
            </div>
            </div>
        </div>
        <!-- les profils -->

        <div class="p-2  sm:px-20 text-black border-b border-gray-200 h-[45rem] lg:h-[25rem] mt-7 mx-5 shadow-2xl rounded-md  bg-white" id="admin" >
            <div class="flex p-8 mt-4 grid grid-cols-1 gap-4 lg:grid-cols-2">
                <div class="w-[29rem] h-[13rem] mr-10 flex flex-col">
                    <span class="text-3xl font-bold mb-4">Nos Administrateurs</span>
                    <span class="text-xl text-gray-500 ">
                        Les administrateurs de l'entreprise sont les <br>seules personnes capables
                        de traiter ou de<br> rejeter les demandes faites par les clients.
                    </span>
                </div>
                <div class="flex grid gap-4 lg:grid-cols-2 lg:gap-16 ">
                   <div class="flex" v-for="user in users" :key="user.id">
                    <img :src="user.profile_photo_url" alt="photo" class="block rounded-full w-24 h-24 object-cover object-center mr-5">

                    <div class="flex flex-col">
                        <a :href="route('details',user.id)"  class="text-2xl font-bold">{{user.name}}</a>
                        <span class="text-gray-800">Administrateurs a Assistancia</span>
                    </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="flex items-center mx-5 mt-7 mb-10 rounded-md max-h-screen mt-1" id="add">
            <div class="flex-1 h-full max-w-[79rem] mx-auto bg-white rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover rounded-md w-full h-full md:w-full md:h-full" src="./re.jpg"
                            alt="img" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <div class="flex justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-primary" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                </svg>
                            </div>
                            <h1 class="mb-4 text-2xl font-bold text-center text-gray-700">
                                Nouveau administrateur
                            </h1>
                            <form method="POST"  @submit.prevent="add" enctype="multipart/form-data">
                                <div>
                                <label class="block text-sm">
                                    Nom
                                </label>
                                <input type="text"  v-model="form.name"
                                    class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    placeholder="" />
                            </div>
                            <div>
                                <label class="block mt-4 text-sm">
                                    E-mail
                                </label>
                                <input
                                    class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    placeholder="" type="email"  v-model="form.email"/>
                            </div>

                            <p class="mt-4">
                                <span class="text-                                                                       text-grey-600 hover:underline">
                                    Le mot de passe par defaut est "password".
                                </span>
                            </p>


                            <button
                                class="block bg-primary w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150  border border-transparent rounded-lg active:bg-primary hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue"
                                type="submit"
                               >
                                Log in
                            </button>

                            </form>





                        </div>
                    </div>

                </div>
            </div>
        </div>

    </AppLayout>
</template>
<script>

    export default {
    data(){
        return{
            autre:false,
            id:'details',
            id1:'admin',
            jojo:null,


        }
    },
    components: { Doughnut },


    methods:{
        DetailsPage(user){
            this.autre = !this.autre;
        },
        CloseDrop()
        {
            this.autre = false;
        },

    }
   }
</script>
