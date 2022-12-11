<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PrimaryButton from '../Components/PrimaryButton.vue'
import Input from '../Components/TextInput.vue'
</script>

<template>
    <AppLayout title="Tableau de bord">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tableau de bord
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-12">
                    Ceci est un test de dashboard
                    <PrimaryButton>
                        dljgln
                    </PrimaryButton>
                    <PrimaryButton>
                        krgjbj
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<<<<<<< HEAD
<style>
</style>
=======
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
