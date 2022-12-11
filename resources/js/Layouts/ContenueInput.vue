<script setup>
import { onMounted, ref } from 'vue';
defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>


<textarea rows="4"
 class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:border-primary focus:ring focus:ring-light focus:ring-opacity-50 focus:bg-inherit bg-blue-100 rounded-md shadow-sm"
 placeholder="formuler votre demande..."
 ref="input"
 :value="modelValue"
 @input="$emit('update:modelValue', $event.target.value)"
 ></textarea>

</template>
