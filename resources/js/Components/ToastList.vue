<script setup>
import { useStore } from '../stores/store.js'
import {Link} from '@inertiajs/vue3';

const store = useStore()
</script>

<template>
  <div class="fixed bottom-3 right-3 flex flex-col ">
    <transition-group name="fade" tag="div" class="flex flex-col space-y-1">

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
                <Link :href="`/product/${toast.id}`">{{ toast.name }}</Link>
                <div class="flex justify-end w-full right font-bold mt-3">
                    <div>
                        R$ {{toast.price}}
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

