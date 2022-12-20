<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import PrimaryButton from '../../Components/PrimaryButton.vue'
import DangerButton from '../../Components/DangerButton.vue'
import SecondaryButton from '../../Components/SecondaryButton.vue'
import ConfirmationModal from '../../Components/ConfirmationModal.vue'
import InputError from '../../Components/InputError.vue'
import MySnackbar from '../../Components/MySnackbar.vue'
import { usePage, useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { ref } from 'vue'
import axios from 'axios'


var done = ref(false);
var show = ref(false);
var msg = ref(null);
var type = ref(null);

const props = defineProps({
    demande: {}
});

var form = useForm({
    feedback: ''
});










</script>
<template>
    <AppLayout title="Details de la demande">
        <div class="md:px-44 px-10 bg-white border-b border-gray-200  mt-7 mx-5 rounded-md shadow-lg flex flex-col md:flex-row flex-wrap gap-4 py-12"
          >
            <div class="w-full flex justify-between flex-wrap">
                <span class="w-1/2">
                    {{ new Date(demande.created_at).toLocaleDateString("fr-FR", {
                    year: 'numeric', month: 'long',
                    day: 'numeric'
                    }) }}
                </span>
                <span class="w-1/2 text-end">
                    par : <strong>{{ demande.auteur.name }}</strong>
                </span>
                <div class="w-full" v-if="demande.status == 'en_attente'">
                    <Vue3Marquee :pauseOnHover="true" class=" font-semibold text-amber-600">
                        Cette demande est en attente
                    </Vue3Marquee>
                </div>
                <div class="w-full" v-if="demande.status == 'en_cours'">
                    <Vue3Marquee :pauseOnHover="true" class=" font-semibold text-green-200">
                        Cette demande est en cours de traitement
                    </Vue3Marquee>
                </div>
                <div class="w-full" v-if="demande.status == 'traite'">
                    <Vue3Marquee :pauseOnHover="true" class=" font-semibold text-green-600">
                        Cette demande a été traitée
                    </Vue3Marquee>
                </div>
                <div class="w-full" v-if="demande.status == 'rejete'">
                    <Vue3Marquee :pauseOnHover="true" class=" font-semibold text-red-600">
                        Cette demande a été rejetée
                    </Vue3Marquee>
                </div>

            </div>


            <div class="w-full border-2 border-light bg-light rounded-lg px-9 py-5">
                <span class="font-bold text-white text-xl">Objet de la demande</span>
                <p class="py-5 whitespace-normal">
                    <span class="block font-bold">{{demande.objet}}</span>
                    {{ demande.contenu }}
                </p>
            </div>

            <div v-if="demande.status=='traite'|| demande.status=='rejete'" class="w-full border-2 border-light bg-dark rounded-lg px-9 py-5">
                <span class="font-bold text-white text-xl">Feedback de la demande</span>
                <p class="py-5 font-bold dark-text-black whitespace-normal">

                    {{ demande.feedback }}
                </p>
            </div>



        </div>
      </AppLayout>
</template>
