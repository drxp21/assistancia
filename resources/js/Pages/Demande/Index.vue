<script setup>
import { ref,defineProps } from 'vue'
import AppLayout from '../../Layouts/AppLayout.vue'

const props = defineProps({
    demandes:[]
})
</script>
<template>
        <AppLayout title="Demandes">
toute demande
{{ demandes }}
        </AppLayout>
</template>
