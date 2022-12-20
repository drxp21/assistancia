use Illuminate\Support\Facades\App;
<script setup>
import { ref } from 'vue';
import AuthenticationCardLogo from '../Components/AuthenticationCardLogo.vue';
import ApplicationMark from '../Components/ApplicationMark.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import DialogModal from '@/Components/DialogModal.vue'
import Checkbox from '@/Components/Checkbox.vue';
import AppLayout from '../Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
//import animation from '../../../public/images/animation500.gif';

var connectmodal2 = ref(false)

var connectmodal = ref(false)

const showingNavigationDropdown = ref(false);

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

const form1 = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit1 = () => {
    form1.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <Head title="Bienvuenue" />


    <nav class="bg-white border-b border-gray-100">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">

                    <div class="shrink-0 flex items-center">
                        <Link :href="route('dashboard')">
                        <ApplicationMark />
                        </Link>
                        <span class="font-extrabold text-2xl flex items-center ml-4">
                            Assistancia
                        </span>
                    </div>







                    <div class="-mr-2 flex items-center sm:hidden">
                        <button
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                            @click="showingNavigationDropdown = !showingNavigationDropdown">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path
                                    :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path
                                    :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }"
                        class="sm:hidden">
                        <div class="pt-2 pb-3 space-y-1">
                            responsive bi
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    <div class="relative bg-white flex  justify-center max-h-screen sm:items-center  sm:pt-1">

        <div class="grid max-w-screen-xl px-4 md:pt-96 md:ml-6 sm:pt-72 pb-8 mx-auto  lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-2">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl font-sans mt-10 mb-10 text-4xl font-bold leading-none tracking-tight md:text-5xl xl:text-5xl text-black">
                    Bienvenue, Faire facilement vos reclamations <br>sans deplacement.</h1>
                <h3
                    class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-3xl xl:text-xl text-black">
                </h3>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-600">
                    cette application vous permet de faire vos reclamations a tout moment avec un traitement rapide et
                    efficace.Vous pouvez aussi voir l'historique de vos demandes avec leurs status . <a
                        href="https://tailwindcss.com" class="hover:underline"></a> <a
                        href="https://flowbite.com/docs/getting-started/introduction/" class="hover:underline"></a> <a
                        href="https://flowbite.com/blocks/" class="hover:underline"></a></p>
                <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                    <Link v-if="$page.props.user" :href="route('dashboard')"
                        class="text-sm text-white dark:text-white-500 bg-dark p-1.5">TABLEAU DE BORD</Link>

                    <template v-else>
                        <button
                            class="inline-flex items-center px-4  py-4 bg-black border border-b border-black rounded-md font-bold text-base text-white  tracking-widest hover:bg-white hover:text-black active:bg-dark focus:outline-none focus:border-gray-900 focus:ring focus:ring-light disabled:opacity-25 transition"
                            @click="Thieur()">
                            Se connecter
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-in-right ml-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                <path fill-rule="evenodd"
                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                        </button>

                        <button v-if="canRegister" :href="route('register')"  class="inline-flex ml-4 items-center px-4  py-4 bg-black border border-b border-black rounded-md font-bold  text-base text-white  tracking-widest hover:bg-white hover:text-black active:bg-dark focus:outline-none focus:border-gray-900 focus:ring focus:ring-light disabled:opacity-25 transition" @click="Dieur()">
                            S'inscrire
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 ml-2 ">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>

                        </button>
                    </template>
                </div>
            </div>
            <div class=" lg:mt-0 lg:col-span-5 lg:flex">
                <img src="../../../public/images/animation640.gif" alt="hero image">
            </div>
        </div>
        <DialogModal :show="show" @close="show = false">
            <template #content>
                <div class="flex justify-center">
                    <AuthenticationCardLogo />
                </div>
                <form @submit.prevent="submit" id="loginform">
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
                </form>
            </template>
            <template #footer>
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    form="loginform">
                    Se connecter
                </PrimaryButton>
            </template>
        </DialogModal>
        <DialogModal :show="show1" @close="Veup()">


            <template #content>
                <div class="flex justify-center">
                    <AuthenticationCardLogo />
                </div>

                <form @submit.prevent="submit1" id="registerform">
                    <div>
                        <InputLabel for="name" value="Nom complet" />
                        <TextInput id="name" v-model="form1.name" type="text" class="mt-1 block w-full" required
                            autofocus autocomplete="name" />
                        <InputError class="mt-2" :message="form1.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" v-model="form1.email" type="email" class="mt-1 block w-full" required />
                        <InputError class="mt-2" :message="form1.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Mot de passe" />
                        <TextInput id="password" v-model="form1.password" type="password" class="mt-1 block w-full"
                            required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form1.errors.password" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirmation" />
                        <TextInput id="password_confirmation" v-model="form1.password_confirmation" type="password"
                            class="mt-1 block w-full" required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form1.errors.password_confirmation" />
                    </div>

                    <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                        <InputLabel for="terms">
                            <div class="flex items-center">
                                <Checkbox id="terms" v-model:checked="form1.terms" name="terms" required />

                                <div class="ml-2">
                                    I agree to the <a target="_blank" :href="route('terms.show')"
                                        class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a>
                                    and <a target="_blank" :href="route('policy.show')"
                                        class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                                </div>
                            </div>
                            <InputError class="mt-2" :message="form1.errors.terms" />
                        </InputLabel>
                    </div>


                </form>
            </template>
            <template #footer>
                <div class="flex items-center justify-end mt-4">
                    <button @click="Dieur()" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Déjà inscrit ?
                    </button>

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form1.processing }" form="registerform"
                        :disabled="form1.processing">
                        S'inscrire
                    </PrimaryButton>

                </div>
            </template>
        </DialogModal>



    </div>
</template>
<script>

export default {
    data() {
        return {
            show1: false,
            show: false



        }
    },



    methods: {
        Thieur() {
            this.show = !this.show;
        },
        Dieur() {
            this.show1 = !this.show1;
            this.show = true;

        },
        Veup() {
            this.show1 = false;
            this.show = false;
        }


    }
}
</script>
