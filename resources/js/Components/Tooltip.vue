<script setup>
import { ref } from 'vue'

defineProps({
    text: {
        type: String,
        required: true
    }
})

const show = ref(false)
</script>

<template>
    <div class="relative inline-block">
        <div class="flex items-center justify-center cursor-pointer"
            @mouseenter="show = true"
            @mouseleave="show = false"
            @click="show = !show">

            <slot />
        </div>

        <Transition
            enter-active-class="transition duration-200"
            leave-active-class="transition duration-150"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <div
                v-if="show"
                class="absolute left-1/2 -translate-x-1/2 mt-1
                       w-60 rounded-lg bg-gray-900 text-white
                       text-sm p-3 z-50 shadow-lg">

                {{ text }}
            </div>
        </Transition>
    </div>
</template>