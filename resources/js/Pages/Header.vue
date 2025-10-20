<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { profilePhoto } from '../profilePhoto.js';
import { useStore } from '../stores/store.js';


const store = useStore();
const user = usePage().props.auth.user;

/***********************************************/

var photoUrl = '';

if(user && user.profile_photo){
    photoUrl = user.profile_photo ? `/storage/${user.profile_photo}` : 'data:image/png;base64,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';
}else{
    photoUrl = 'data:image/png;base64,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';
}

</script>

<template>
  <div class="fixed z-50 top-0 w-full shadow shadow-slate-300 bg-white">
    <div class="container__own bg-white mx-auto flex justify-between items-center h-16">

      <!-- Logo -->
      <div class="font-light">
        <Link href="/home">Logo</Link>
      </div>

      <!-- Menu -->
      <ul class="flex gap-6 text-sm font-medium text-slate-700">
        <li>
          <Link href="/home"
                class="hover:border-b-2 hover:text-blue-500 border-blue-500">
            Home
          </Link>
        </li>
        <li>
          <Link href="/store"
                class="hover:border-b-2 hover:text-blue-500 border-blue-500">
            Loja
          </Link>
        </li>
        <li>
          <Link href="#"
                class="hover:border-b-2 hover:text-blue-500 border-blue-500">
            Ranking
          </Link>
        </li>
      </ul>

      <!-- Right side: Search + Cart + Favorite + User -->
      <ul class="flex items-center gap-4 text-sm font-semibold text-slate-700">

        <!-- Search input -->
        <li class="relative">
            <div class="relative w-48 h-9">
                <input
                type="text"
                placeholder="Search..."
                class="absolute right-0 w-full h-9 focus:w-80 transition-[width] duration-300 ease-in-out
                        bg-transparent border border-gray-300 focus:border-none focus:ring-2 focus:ring-gray/30
                        text-gray-700 placeholder-gray-400 rounded-xl px-2"
                />
                <ion-icon
                name="search-outline"
                class="absolute right-2 top-4 -translate-y-1/2 text-2xl text-gray-700 cursor-pointer"
                ></ion-icon>
            </div>
        </li>

        <!-- Cart -->
        <li class="relative">
          <Link href="/cart" class="transition hover:-translate-y-1 hover:text-black">
            <ion-icon name="cart-outline" class="text-2xl"></ion-icon>
            <div class="absolute -mt-8 ml-3 pt-0 pl-1 pr-1 pb-0 bg-black rounded-full text-xs font-normal text-white">
              {{ store.qtd_cart }}
            </div>
          </Link>
        </li>

        <!-- Favorite -->
        <li class="relative">
          <Link href="/favorite" class="transition hover:-translate-y-1 hover:text-black">
            <ion-icon name="heart-outline" class="text-2xl"></ion-icon>
            <div class="absolute -mt-8 ml-3 pt-0 pl-1 pr-1 pb-0 bg-black rounded-full text-xs font-normal text-white">
              {{ store.qtd_favorites }}
            </div>
          </Link>
        </li>

        <!-- User dropdown / Login -->
        <li>
          <div v-if="$page.props.auth.user">
            <div class="flex h-16 justify-between">
              <div class="hidden sm:ms-6 sm:flex sm:items-center">
                <div class="relative">
                  <Dropdown align="right" width="48">
                    <template #trigger>
                      <span class="inline-flex rounded-md">
                        <button
                          type="button"
                          class="inline-flex items-center rounded-md border border-transparent bg-white text-sm font-medium text-black transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                        >
                          <img
                            class="w-7 h-7 mr-2 rounded-full"
                            :src="photoUrl"
                          />
                          {{ $page.props.auth.user.name }}
                          <svg
                            class="-me-0.5 ms-1 h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"
                            />
                          </svg>
                        </button>
                      </span>
                    </template>

                    <template #content>
                      <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                      <DropdownLink :href="route('profile.edit')">Points</DropdownLink>
                      <DropdownLink :href="route('profile.edit')">Orders</DropdownLink>
                      <DropdownLink :href="route('logout')" method="post" as="button" class="border-t border-gray-100">Log out</DropdownLink>
                    </template>
                  </Dropdown>
                </div>
              </div>
            </div>
          </div>
          <div v-else>
            <Link href="/login" class="font-medium transition-all hover:-translate-y-1 hover:text-black">
              Login
            </Link>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>
