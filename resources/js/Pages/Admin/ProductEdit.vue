<script setup>
import Main from "./partials/Main.vue";
import { useForm } from '@inertiajs/vue3'
import { onMounted, reactive, ref } from 'vue';

const inputRef = ref(null);
const previewUrl = ref([]);
const id_photo = ref();
const selectedCategory = reactive({
    id: '',
    name: ''
});

const props = defineProps({
    product: Object,
    category: Array
})

// Cria o form com dados vindos do props
const form = useForm({
  id: props.product.id,
  name: props.product.name,
  category_id: props.category.id,
  from_price: props.product.from_price,
  price: props.product.price,
  description: props.product.description,
  _method: 'PATCH'
})

function submit(){
    form.patch(route('admin.update.product', { product: props.product.id }));
}

function editImage(event){
    event.preventDefault();
    id_photo.value = event.currentTarget.dataset.id_photo;
    inputRef.value?.click()
}

async function teste(event) {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    const formData = new FormData();
    formData.append('photo', event.target.files[0]);
    for (let [key, value] of formData.entries()) {
        //console.log(key, value);
    }

    const path = window.location.pathname; // '/admin/edit-product/15'
    const parts = path.split('/'); // ["", "admin", "edit-product", "15"]
    const id_product = parts[3]; // "15"
    formData.append('id_product', id_product);
    formData.append('id_photo', id_photo.value);

  try {
    const response = await fetch('/admin/update-teste', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': token,
      },
      body: formData
    })
    const data = await response.json()
    if(response.ok){
        window.location.reload();
    }
    console.log('Reposta:', data)
  } catch (err) {
    console.error('Erro na requisição:', err)
  }
}

onMounted(() =>{
    selectedCategory.id = props.product.category.id
    selectedCategory.name = props.product.category.name
})
function updateCategoryId(newName) {
    console.log("Selecionado:", newName)

    // Acha a categoria pelo nome
    const cat = props.category.find(e => e.name === newName)

    if (cat) {
        selectedCategory.id = cat.id
        selectedCategory.name = cat.name

        // Atualiza o form
        form.category_id = cat.id
    }
}

function deletePhoto(id){
    alert(id)
}

</script>
<template>
    <div>
         <Main>
             <div class="bg-blue-950 p-4 text-white">Edit Product</div>
             <form @submit.prevent="submit"
             class="max-w-md  p-6 bg-white rounded shadow-md space-y-6">

            <!--Campo Imagem-->
            <div class="flex">

                <img v-if="previewUrl" :src="previewUrl" class="w-32 mt-2" />

                <input type="file" ref="inputRef" hidden @change="teste" />

                <div class="flex flex-col p-1" v-for="prod in product.product_images" :key="prod.id" >
                    <button class="bg-red-500"
                    @click="deletePhoto">Excluir</button>
                    <!----->
                    <img class="mx-auto rounded-sm" :src="`/storage/${prod.path}`" />
                    <!----->
                    <button  class="bg-green-500" :data-id_photo="prod.id"
                    @click="editImage">Editar</button>
                </div>
            </div>
            <div>
                {{ selectedCategory.name }}
                <div class="block text-sm font-medium text-gray-700 mb-1 ">Category</div>
                <select v-model="selectedCategory.name"
                    @change="updateCategoryId($event.target.value)"
                    class="w-full border-gray-300 rounded">
                    <option v-for="cat in props.category" :key="cat.id" :value="cat.name">
                        {{ cat.name }}
                    </option>
                </select>

            </div>
            <!-- Campo Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter product name"
                    v-model="form.name"
                />
            </div>

            <!-- Campo From Price -->
            <div>
            <label for="from_price" class="block text-sm font-medium text-gray-700 mb-1">From Price</label>
            <input
                type="number"
                id="from_price"
                name="from_price"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter from price"
                min="0"
                step="0.01"
                v-model="form.from_price"
            />
            </div>

            <!-- Campo Price -->
            <div>
            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
            <input
                type="number"
                id="price"
                name="price"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter price"
                min="0"
                step="0.01"
                v-model="form.price"
            />
            </div>

            <!-- Campo Description -->
            <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea
                id="description"
                name="description"
                rows="4"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter description"
                v-model="form.description"
            ></textarea>
            </div>

            <!-- Botão Submit -->
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
                :disabled="form.processing"
                >
                    {{ form.processing ? 'Salvando...' : 'Salvar' }}
                </button>
            </form>
                </Main>
            </div>

</template>
