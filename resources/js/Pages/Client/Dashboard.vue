<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import { defineProps, onMounted, reactive, ref } from 'vue'
import { Head, Link, Inertia } from '@inertiajs/inertia-vue3';
import noresult from '../../../../public/images/no-results.png'
import ListElement from '../../Components/DemandeListElement_client.vue';
import PrimaryButton from '../../Components/PrimaryButton.vue';
import form from '../../../../public/images/gettyimages-1162928061-612x612.jpg'
import liste from '../../../../public/images/OIP.jpg'


import DetailDemande from './DetailDemande.vue';

const props = defineProps({
    nbre_demande_en_att : 0,
    nbre_demande_en_cours : 0,
    nbre_demande_rejete : 0,
    mes_demandes: {},

});



</script>
<template>
    <AppLayout title="Dashboard client">

        <div class="p-6  sm:px-20 text-black border-b border-gray-200  mt-7 mx-5 rounded-md shadow-2xl bg-light" >
            <div class="flex items-center text-3xl lg:text-5xl font-bold">
                <h1>Bienvenue {{$page.props.user.name}} 🙂</h1>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mx-4">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 01.198-.471 1.575 1.575 0 10-2.228-2.228 3.818 3.818 0 00-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0116.35 15m.002 0h-.002" />
                </svg>


            </div>
            <div class="mt-3 text-2xl">Ici vous pouvez soumettre vos demandes et trouver les infos relatives a vos demandes .</div>
        </div>



        <div class=" overflow-y-auto  w-full mb-4 px-4 py-5 md:h-auto h-full">


            <div class="grid grid-cols-1  md:grid-cols-3 justify-items-center">

<div class=" mb-7 w-5/6 ">
<div class="flex flex-col  md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg h-11/12">
<div class="p-6 flex flex-col justify-center ">
<h5 class="text-gray-900 text-xl font-medium mb-2">Nombre de demandes  <br>en attente</h5>
<div class="flex justify-center w-full">

    <div class=" rounded-full h-16 w-16 flex justify-center   bg-amber-400 m-2 p-2">
    <h2 class="text-4xl text-white text-center p-1">{{nbre_demande_en_att}}</h2></div>

</div>
</div>

</div>
</div>

<div class=" mb-7 w-5/6 h-full">
<div class="flex flex-col  md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg h-11/12">
<div class="p-6 flex flex-col ">
<h5 class="text-gray-900 text-xl font-medium mb-2">nombre de demandes <br> cours</h5>
<div class="flex justify-center w-full">

<div class=" rounded-full h-16 w-16 flex justify-center  bg-green-200 m-2 p-2">
<h2 class="text-4xl text-white text-center p-1">{{nbre_demande_en_cours}}</h2></div>
</div>
    </div>
</div>
</div>


<div class=" mb-7 w-5/6 h-full ">
<div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg h-11/12">
<div class="p-6 flex flex-col justify-start">
<h5 class="text-gray-900 text-xl font-medium mb-2">nombre de demandes <br> rejete</h5>
<div class="flex justify-center w-full">

    <div class=" rounded-full h-16 w-16 flex justify-center  bg-red-600 m-2 p-2">
    <h2 class="text-4xl text-white text-center p-1">{{nbre_demande_rejete}}</h2></div>
</div>
    </div>
</div>
</div>






</div>


                <div class="grid grid-cols-1  lg:grid-cols-2 justify-items-center w-full ">

                    <div class=" mb-6 ">
  <div class="flex flex-col  md:flex-row md:max-w-xl rounded-lg bg-dark shadow-lg h-11/12">
    <img class=" w-full h-full md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg" src="../../../../public/images/gettyimages-1162928061-612x612.jpg" alt="" />
    <div class="p-6 flex flex-col justify-start">
      <h5 class="text-white text-xl font-medium mb-2">Soumettre une demande</h5>
      <p class=" text-base mb-4">
        Pour soumettre une nouvelle réclamation, cliquez sur le bouton ci-dessous.
      </p>
      <br>
    <Link :href="route('create.demande')">   <button type="button" class="inline-block px-6 py-2 border-2 border-light text-light font-medium text-xs leading-tight uppercase rounded-full hover:bg-light hover:text-white hover:bg-opacity-1 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">remplir le formulaire</button></Link>

    </div>
  </div>
</div>


<div class=" mb-6 ">
  <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-dark shadow-lg h-11/12">
    <img class=" w-full h-full   md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg" src="../../../../public/images/OIP.jpg" alt="" />
    <div class="p-6 flex flex-col justify-start">
      <h5 class="text-white text-xl font-medium mb-2">mes demandes</h5>
      <p class=" text-base mb-4">
       pour voir la liste de vos demandes et les details ,  cliquez sur le bouton ci-dessous.
      </p>
      <br>

      <Link :href="route('show.demande')">   <button type="button" class="inline-block px-6 py-2 border-2 border-light text-light font-medium text-xs leading-tight uppercase rounded-full hover:bg-light hover:text-white hover:bg-opacity-1 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Voir mes demandes</button></Link>
    </div>
  </div>
</div>






            </div>

            </div>





    </AppLayout>
</template>
