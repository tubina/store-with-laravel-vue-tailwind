<script setup>
import { ref, watch } from 'vue';
import { useStore } from '../stores/store.js';

const store = useStore();

const props = defineProps({
    message: Array
})

const show = ref(false);

watch(() => props.message, (newValue) => {
  if (newValue) {
    show.value = true;
    setTimeout(() => (show.value = false), 3000);
  }
});

</script>

<template>
    <div v-if="show === true"
    class="fixed bottom-3 right-3 shadow-lg rounded text-sm bg-white px-3 py-2">
        <div class="flex w-52">
            <img class="w-10 h-10 rounded" :src="`/storage/${message[0]}`" />
            {{ message[1] }}
        </div>
    </div>
</template>
