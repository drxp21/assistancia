<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import PrimaryButton from '../../Components/PrimaryButton.vue'
import DangerButton from '../../Components/DangerButton.vue'
import SecondaryButton from '../../Components/SecondaryButton.vue'
import ConfirmationModal from '../../Components/ConfirmationModal.vue'
import InputError from '../../Components/InputError.vue'
import InputLabel from '../../Components/InputLabel.vue'
import MySnackbar from '../../Components/MySnackbar.vue'
import { usePage, useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { ref } from 'vue'
import axios from 'axios'


var done = ref(false)
var show = ref(false)
var msg = ref(null)
var type = ref(null)

const props = defineProps({
    demande: {}
})

var form = useForm({
    feedback: ''
})

const traiter = () => {
    axios.put(route('admin.handle_demande', {
        demande_id: props.demande.id,
        admin_id: usePage().props.value.user.id
    })).then(res => {
        Inertia.reload({
            only: ['demande'],
        })
    })
}


const sendFeedback = () => {
    form.put(route('admin.feedback', {
        demande_id: props.demande.id,
        demande_auteur: props.demande.auteur,
        type: 'feedback'
    }), {
        onSuccess: () => {
            msg.value = "Demande traitée avec succes ! Feedback envoyé"
            type.value = "success"
            done.value = true
            setTimeout(() => {
                done.value = false
            }, 3000);
        }
    }
    )
}

const rejet = () => {

    show.value = false
    form.put(route('admin.feedback', {
        demande_id: props.demande.id,
        demande_auteur: props.demande.auteur,
        type: 'rejet'
    }), {
        onSuccess: () => {
            msg.value = "Demande rejetée avec succes !"
            type.value = "danger"
            done.value = true
            setTimeout(() => {
                done.value = false
            }, 3000);
        }
    }
    )
}
</script>
<template>
    <AppLayout title="Details de la demande">
        <div class="md:px-44 px-10 bg-white border-b border-gray-200  mt-7 mx-5 rounded-md shadow-lg flex flex-col md:flex-row flex-wrap gap-4 py-12"
            v-if="demande.admin_id==$page.props.user.id || demande.admin_id==null">
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
                <div class="w-full" v-if="demande.status == 'en_cours'">
                    <Vue3Marquee :pauseOnHover="true" class=" font-semibold text-amber-600">
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
            <div class="w-full border-2 border-gray-300 rounded-lg px-9 py-5">
                <span class="font-bold text-xl">Objet de la demande</span>
                <p class="py-5 whitespace-pre-wrap">
                    <span class="block font-bold">{{demande.objet}}</span>
                    {{ demande.contenu }}
                </p>
            </div>
            <div class="w-full" v-if="!demande.admin_id">
                <div class="w-full flex justify-end">
                    <PrimaryButton @click="traiter()">
                        Prendre en charge
                    </PrimaryButton>
                </div>
            </div>
            <form class="w-full" v-else @submit.prevent="sendFeedback()">
                <hr class="my-5">
                <InputLabel for="feedback" value="Feedback" />
                <textarea
                    class="w-full border-2 border-gray-300 rounded-lg focus:ring-0 focus:border-gray-400 px-9 py-5 h-44"
                    :placeholder="demande.feedback ? demande.feedback : 'Votre feedback ou motif de rejet ici'"
                    v-model="form.feedback" required :disabled="demande.status != 'en_cours'">

                </textarea>
                <InputError :message="form.errors.feedback" />
                <div class="w-full flex justify-between my-4"  v-if="demande.status == 'en_cours'">
                    <DangerButton @click="show=true" :disabled="form.processing">
                        Rejeter
                    </DangerButton>
                    <PrimaryButton :disabled="form.processing">
                        Envoyer le feed back
                    </PrimaryButton>
                </div>
            </form>
            <ConfirmationModal :show="show">
                <template #title>
                    Rejet de la demande
                </template>
                <template #content>
                    Vous etes sur le point de rejeter cette demande. Elle sera signalée comme rejetée
                </template>
                <template #footer>
                    <SecondaryButton class="mx-2" @click="show=false">
                        Annuler
                    </SecondaryButton>
                    <DangerButton @click="rejet()">
                        Rejeter
                    </DangerButton>
                </template>
            </ConfirmationModal>
            <MySnackbar :type="type" :msg="msg" v-show="done" />
        </div>
        <div v-else
            class="md:px-44 px-10 bg-white border-b border-gray-200  mt-7 mx-5 rounded-md shadow-lg flex flex-col md:flex-row flex-wrap gap-4 py-12">
            Cette demande a deja ete prise en compte par un autre administrateur
        </div>
    </AppLayout>
</template>
