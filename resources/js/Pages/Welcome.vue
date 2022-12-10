<script setup>
import {ref } from 'vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import DialogModal from '@/Components/DialogModal.vue'
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
//import animation from '../../../public/images/animation500.gif';


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
        class="relative bg-light flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center  sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('dashboard')"
                class="text-sm text-white dark:text-white-500 bg-dark p-1.5">PAGE DEMANDES</Link>

            <template v-else>
            <PrimaryButton class="mr-4" @click="connectmodal=true">
                SE CONNECTER
            </PrimaryButton>

            <PrimaryButton>
                <Link v-if="canRegister" :href="route('register')" class="">S'INSCRIRE </Link>
            </PrimaryButton>
            </template>
        </div>

        <div class="flex grid-cols-2">

            <div> <img src="../../../public/images/animation640.gif" alt="images"
                    class="max-w-full cover justify-center "></div>
        </div>

        <div>
            <h2 class="text-center text-3xl"> BIENVENUE😀</h2>
            <br>
            <p> Faites vos reclamations a tout moment pour un traitement rapide et efficace.</p>

            <br>
            <br> <br> <br>
            <h1 id="text" class="text-4xl">Votre satisfaction, notre priorite. </h1>
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



    </div>
</template>
