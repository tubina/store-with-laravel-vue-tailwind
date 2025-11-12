<script setup>
import { useStore } from '../stores/store.js'

const store = useStore()
</script>

<template>
  <div class="fixed bottom-3 right-3 flex flex-col gap-2">
    <transition-group name="fade" tag="div">

      <div
        v-for="toast in store.toasts"
        :key="toast.id"
        class="flex-col w-80 bg-white shadow-lg rounded px-3 py-3"
      >
        <div class="flex">
            <img
            :src="`/storage/${toast.image}`"
            class="w-14 h-14 object-cover rounded mr-2"
            />
            <div class="flex flex-col w-full">
                <div>{{ toast.name }} dadfsdssdfsddsd fdffsdss</div>
                <div class="flex justify-end w-full right font-bold mt-3">
                    <div>
                        R$ 500,00
                    </div>
                </div>
            </div>
        </div>
      </div>
    </transition-group>
  </div>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: all 0.4s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
  transform: translateY(10px);
}
</style>


<!-- <script setup>
import { ref, watch } from 'vue';
import { useStore } from '../stores/store.js';

const store = useStore();

const props = defineProps({
    message: Object,
    keyValue: Number
})

const show = ref(false);
let timeoutId = null;

watch(
  () => props.keyValue,
  () => {
    show.value = true

    if(timeoutId) clearTimeout(timeoutId);

    timeoutId = setTimeout(() => {
        show.value = false,
        timeoutId = null
    }, 5000)
  }
)

// watch(
//   () => [props.message?.image, props.message?.name],
//   (newValue) => {
//     if (newValue[0] && newValue[1]) {
//       show.value = true
//       setTimeout(() => (show.value = false), 3000)
//     }
//   },
//   { deep: true, immediate: true } // 🔹 "deep" e "immediate" ajudam muito aqui
// )

</script>

<template>
    <div v-if="show === true"
    class="fixed bottom-3 right-3 shadow-lg rounded text-sm bg-white px-3 py-2">
        <div class="flex w-52">
            <img class="w-10 h-10 rounded-sm" :src="`/storage/${message.image}`" />
            <span class="text-sm pl-2">{{ message.name }}</span>
            <span class="text-sm pl-2">{{ message.price }}</span>
        </div>
    </div>
</template> -->
