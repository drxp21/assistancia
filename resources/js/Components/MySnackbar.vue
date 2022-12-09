<script setup>

const props=defineProps({
    msg:'',
    type:'',

})



</script>
<template>
        <transition enter-active-class="ease-out duration-300"
            enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200"
            leave-from-class="opacity-100 translate-y-0 sm:scale-100"
            leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

            <div :class="type =='success' ? 'bg-green-100 border-l-4 border-green-500 text-green-700 p-4' : 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4'"
            class="h-14 fixed m-0 right-7 bottom-4 rounded-lg" role="alert">
              <p class="font-bold text-sm">{{ msg }}</p>
            </div>
        </transition>


</template>
