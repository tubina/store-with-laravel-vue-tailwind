<script setup>
import {Link} from "@inertiajs/vue3";

</script>
<template>
<div class="container__own mt-24 overflow-x-auto">
  <table class="min-w-full border rounded-md border-gray-200 text-sm bg-white">
    <thead class="border rounded-md ">
      <tr>
        <th class="px-4 py-2 text-left">Image</th>
        <th class="px-4 py-2 text-left">Category</th>
        <th class="px-4 py-2 text-left">Type</th>
        <th class="px-4 py-2 text-left">Status</th>
        <th class="px-4 py-2 text-left">Price</th>
        <th class="px-4 py-2 text-left">Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- item 1 -->
      <tr class="border-t">
        <td class="px-4 py-2">
          <div class="flex items-center gap-2">
            <button class="bg-white text-black px-2 py-1 rounded
                hover:bg-gray-100 text-xs font-bold">X</button>
            <img
              src="https://www.nextdaycamera.co.uk/acatalog/CanonEOSR5+RF24-105f4L+adapter-2.jpg"
              alt="Product"
              class="rounded border border-gray-200 w-20
              p-2"
            />
          </div>
        </td>
        <td class="px-4 py-2 font-medium">
          <Link href="/product">
            43″ Class TU7000 Series Crystal UHD 4K Smart TV
          </Link>
        </td>
        <td class="px-4 py-2">Television</td>
        <td class="px-4 py-2">appliances</td>
        <td class="px-4 py-2 text-green-800 font-semibold">In Stock</td>
        <td class="px-4 py-2">$1,599.00</td>
        <td class="px-4 py-2">
          <button class="text-xs bg-black text-white px-3 py-2 rounded hover:bg-neutral-800">
            Add to Cart
          </button>
        </td>
      </tr>
      <!-- item 2 -->
      <tr class="border-t">
        <td class="px-4 py-2">
          <div class="flex items-center gap-2">
            <button class="bg-white text-black px-2 py-1 rounded hover:bg-gray-100 text-xs font-bold">X</button>
            <img
              src="https://www.nextdaycamera.co.uk/acatalog/CanonEOSR5+RF24-105f4L+adapter-2.jpg"
              alt="Product"
              class="rounded border border-gray-200 w-20
              p-2"
            />
          </div>
        </td>
        <td class="px-4 py-2 font-medium">
          iPhone 14 Pro Max 256GB
        </td>
        <td class="px-4 py-2">Smartphone</td>
        <td class="px-4 py-2">electronics</td>
        <td class="px-4 py-2 text-green-800 font-semibold">In Stock</td>
        <td class="px-4 py-2">$1,099.00</td>
        <td class="px-4 py-2">
          <button class="text-xs bg-black text-white px-3 py-2 rounded hover:bg-neutral-800">
            Add to Cart
          </button>
        </td>
      </tr>
      <!-- item 3 -->
      <tr class="border-t">
        <td class="px-4 py-2">
          <div class="flex items-center gap-2">
            <button class="bg-white text-black px-2 py-1 rounded hover:bg-gray-100 text-xs font-bold">X</button>
            <img
              src="https://www.nextdaycamera.co.uk/acatalog/CanonEOSR5+RF24-105f4L+adapter-2.jpg"
              alt="Product"
              class="rounded border border-gray-200 w-20
              p-2"
            />
          </div>
        </td>
        <td class="px-4 py-2 font-medium">
          PlayStation 5 Console
        </td>
        <td class="px-4 py-2">Gaming</td>
        <td class="px-4 py-2">entertainment</td>
        <td class="px-4 py-2 text-red-600">Out of Stock</td>
        <td class="px-4 py-2">$499.00</td>
        <td class="px-4 py-2">
          <button class="bg-gray-400 text-white px-3 py-1 rounded cursor-not-allowed" disabled>
            Sold Out
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

</template>
