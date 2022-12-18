<script setup>
import {ref } from 'vue';

import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import DialogModal from '@/Components/DialogModal.vue'
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
//import animation from '../../../public/images/animation500.gif';

var connectmodal2=ref(false)
var connectmodal=ref(false)
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    canResetPassword: Boolean,
    status: String,
});


const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Welcome" />


    <div
        class="relative bg-white flex items-top justify-center max-h-screen sm:items-center  sm:pt-0">



        <div class="grid max-w-screen-xl px-4 pt-1 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-2">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mt-24 mb-24 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl text-black">Bienvenue a Assistancia</h1>
                <h3 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-3xl xl:text-6xl text-black">Faire facilement  vos reclamations <br>sans deplacement.</h3>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-600">cette application vous permet de faire vos reclamations a tout moment avec un traitement rapide et efficace.Vous pouvez aussi voir l'historique de vos demandes avec leurs status . <a href="https://tailwindcss.com" class="hover:underline"></a>  <a href="https://flowbite.com/docs/getting-started/introduction/" class="hover:underline"></a> <a href="https://flowbite.com/blocks/" class="hover:underline"></a></p>
                <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                    <Link v-if="$page.props.user" :href="route('dashboard')"
                                        class="text-sm text-white dark:text-white-500 bg-dark p-1.5">TABLEAU DE BORD</Link>

                                        <template v-else>
            <PrimaryButton class="mr-4" @click="connectmodal=true">
                SE CONNECTER
            </PrimaryButton>

            <PrimaryButton  v-if="canRegister" :href="route('register')" class="mr-4" @click="Thieur()">
              S'INSCRIRE
            </PrimaryButton>
            </template>
                </div>
            </div>
            <div class=" lg:mt-0 lg:col-span-5 lg:flex">
                <img  src="../../../public/images/animation640.gif" alt="hero image">
            </div>
        </div>
        <DialogModal :show="connectmodal">
            <template #content>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required
                            autofocus />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Mot de passe" />
                        <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full"
                            required autocomplete="current-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox v-model:checked="form.remember" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                    </div>
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Se connecter
                    </PrimaryButton>
                    <SecondaryButton class="ml-4" @click="connectmodal=false">
                        Annuler
                    </SecondaryButton>


                </form>
            </template>
        </DialogModal>
        <DialogModal :show="show1" >

<template #content>
    <form @submit.prevent="submit">
<div>
    <InputLabel for="name" value="Nom complet" />
    <TextInput
        id="name"
        v-model="form.name"
        type="text"
        class="mt-1 block w-full"
        required
        autofocus
        autocomplete="name"
    />
    <InputError class="mt-2" :message="form.errors.name" />
</div>

<div class="mt-4">
    <InputLabel for="email" value="Email" />
    <TextInput
        id="email"
        v-model="form.email"
        type="email"
        class="mt-1 block w-full"
        required
    />
    <InputError class="mt-2" :message="form.errors.email" />
</div>

<div class="mt-4">
    <InputLabel for="password" value="Mot de passe" />
    <TextInput
        id="password"
        v-model="form.password"
        type="password"
        class="mt-1 block w-full"
        required
        autocomplete="new-password"
    />
    <InputError class="mt-2" :message="form.errors.password" />
</div>

<div class="mt-4">
    <InputLabel for="password_confirmation" value="Confirmation" />
    <TextInput
        id="password_confirmation"
        v-model="form.password_confirmation"
        type="password"
        class="mt-1 block w-full"
        required
        autocomplete="new-password"
    />
    <InputError class="mt-2" :message="form.errors.password_confirmation" />
</div>

<div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
    <InputLabel for="terms">
        <div class="flex items-center">
            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

            <div class="ml-2">
                I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
            </div>
        </div>
        <InputError class="mt-2" :message="form.errors.terms" />
    </InputLabel>
</div>

<div class="flex items-center justify-end mt-4">
    <Link @click="Dieur()"  class="underline text-sm text-gray-600 hover:text-gray-900">
        Déjà inscrit ?
    </Link>

    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        S'inscrire
    </PrimaryButton>
</div>
</form>
</template>
</DialogModal>




    </div>
</template>
<script>

    export default {
    data(){
        return{
            show1:false,
            show:false



        }
    },



    methods:{
        Thieur(){
            this.show1 = !this.show1;
        },
        Dieur(){
            this.show1 = false;
            this.show = true;
        },


    }
   }
</script>
