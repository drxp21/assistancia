<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { defineProps, onMounted, reactive, ref, } from 'vue'
import { Head, Link, useForm, Inertia } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import TextInput from '../../Components/TextInput.vue';
import SecondaryButton from '../../Layouts/AppLayout.vue'
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ContenueInput from '@/Layouts/ContenueInput.vue';
import FormDemandeCard from '@/Layouts/ContenueInput.vue';
import help from '/public/images/help.gif';

import anim from '../../../../public/images/animation500form.gif';


const props = defineProps({
    demandes: {
        type: Object,
        default: () => ({}),
    },
});
const form = useForm({
    objet: '',
    contenu: '',

});

const submit = () => {
    console.log('ekip')
    form.post(route('store.demande'));
};

</script>
<template>
    <AppLayout title="Dashboard Admin">


        <div class="p-6 sm:px-20 bg-dark text-white border-b border-gray-200  mt-7 mx-5 rounded-md shadow-lg">
            Formulaires de demandes
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 place-items-center md:ml-6 mt-8">

            <div key="" flex flex-wrap> <img src="../../../../public/images/animation500form.gif" alt="un gif"
                    class=" max-w-full  align-middle " />  </div>
            <div class="w-full sm:max-w-md mt-6 px-8 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <Head title="faire une demande" />
                <form @submit.prevent="submit()">
                    <div class="form-control">
                        <InputLabel for="objet" value="objet" />
                        <TextInput id="objet" v-model="form.objet" type="text"
                            class="mt-1 block w-full focus:bg-inherit bg-blue-100" required autofocus
                            autocomplete="objet" />

                            <InputError class="mt-2" :message="form.errors.objet" />

                        <br>
                        <InputLabel for="contenu" value="contenu" />
                        <ContenueInput id="contenu" v-model="form.contenu" required autofocus autocomplete="contenu" />
                        <InputError class="mt-2" :message="form.errors.contenu" />
                    </div>

                    <br>
                    <div class="flex items-center justify-end mt-4">
                        <Link :href="route('dashboard')"
                            class="underline text-sm text-gray-600 hover:text-gray-900">
                        annuler
                        </Link>

                        <PrimaryButton class="ml-4">
                            envoyer

                        </PrimaryButton>
                    </div>
                </form>


            </div>

        </div>








    </AppLayout>

</template>



<style>

</style>
