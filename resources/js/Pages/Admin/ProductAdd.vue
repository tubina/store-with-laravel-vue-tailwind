<script setup>
import Main from "./partials/Main.vue";
import { useForm } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'

const success = ref(null);
const images = ref([])
const previewUrls = ref([])
const fileInput = ref(null)

const props = defineProps({
    categories: Array
})

 const form = useForm({
  name: '',
  from_price: '',
  price: '',
  description: '',
  category_id: '',
  images: []
});

function onFileChange(event) {
  const files = Array.from(event.target.files)
  form.images = files
  images.value = files
  previewUrls.value = []

  files.forEach((file) => {
    const url = URL.createObjectURL(file)
    previewUrls.value.push(url)
  })
}

function submitForm() {
  // Aqui você pode fazer a requisição para o backend, por exemplo com fetch ou axios
  console.log('Dados do produto:', form);
  form.post(route('admin.store.product'),{
    onSuccess: () => {
        fileInput.value.value = null;
        previewUrls.value = []
        form.reset();
        success.value = "Sent Successfully!!!"
        setTimeout(()=>{
            success.value = '';
        }, 3000);
    }
  });
}

</script>

<template>
    <div>
         <Main>
            <form @submit.prevent="submitForm" class="max-w-md p-6 bg-white rounded shadow-md space-y-6">

                <div>
                    <!-- <input type="file" name="images[]" multiple
                    @change="e => form.images = Array.from(e.target.files)"
                    class="block w-full text-sm text-gray-900 border
                    border-gray-300 rounded-lg cursor-pointer
                    bg-gray-50 focus:outline-none focus:ring-2
                    focus:ring-blue-500 focus:border-blue-500 mb-2" /> -->

                    <div v-if="success" class="w-full h-50 p-1 text-white bg-green-500 rounded-sm">
                        {{ success }}
                    </div>

                <!-- Previews -->
                <div class="flex flex-wrap gap-4 mt-4">
                    <div v-for="(url, index) in previewUrls" :key="index" class="w-24 h-24 overflow-hidden rounded border">
                        <img :src="url" class="w-full h-full object-cover" />
                    </div>
                </div>

                <input type="file" name="images[]" multiple
                @change="onFileChange"
                ref="fileInput"
                class="block w-full text-sm text-gray-900 border
                border-gray-300 rounded-lg cursor-pointer
                bg-gray-50 focus:outline-none focus:ring-2
                focus:ring-blue-500 focus:border-blue-500 mb-2" />

                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select
                        id="category"
                        name="category"
                        class="block w-full border border-gray-300 rounded px-3 py-2 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        v-model="form.category_id"
                    >
                        <option disabled value="">Select a category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.name }}
                        </option>
                    </select>
                </div>

                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome do Produto</label>
                <input
                    id="name"
                    type="text"
                    v-model="form.name"
                    placeholder="Digite o nome do produto"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                </div>

                <div>
                <label for="from_price" class="block text-sm font-medium text-gray-700 mb-1">Preço de Origem</label>
                <input
                    id="from_price"
                    type="number"
                    v-model="form.from_price"
                    min="0"
                    step="0.01"
                    placeholder="Digite o preço de origem"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                </div>

                <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Preço</label>
                <input
                    id="price"
                    type="number"
                    v-model="form.price"
                    min="0"
                    step="0.01"
                    placeholder="Digite o preço"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                </div>

                <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea
                    id="description"
                    v-model="form.description"
                    rows="4"
                    placeholder="Digite a descrição do produto"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
                </div>

                <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
                >
                Cadastrar Produto
                </button>

            </form>
         </Main>
    </div>

</template>
