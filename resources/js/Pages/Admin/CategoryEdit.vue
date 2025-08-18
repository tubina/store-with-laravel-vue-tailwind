<script setup>
import { useForm } from '@inertiajs/vue3';
import Main from './partials/Main.vue';
import { ref } from 'vue';

var selectedOptionEdit = ref('selecione');
var selectedOptionAdd = ref('');

const props = defineProps({
    category: Object
})

async function editCategory(){
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const formData = new FormData();
    //formData.append('id', selectedOption.value.id);
    formData.append('_method', 'PATCH');
    formData.append('name', selectedOptionEdit.value.value);

    try {
    const res = await fetch(`/admin/categoryEdit/${selectedOptionEdit.value.id}`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': token
      },
      body: formData
    });

    if (!res.ok) {
      const error = await res.text();
      console.error('Erro do servidor:', error);
      throw new Error(error);
    }

    const data = await res.json();
    if(data.message === 'ok'){
        window.location.reload();
    }
    console.log('Atualizado com sucesso:', data);
  } catch (err) {
    console.error('Erro na requisição:', err);
  }
}

const form = useForm({
    name: '',
    cat: ''
})

function save(){
    form.post('/admin/add-category',{
        onSuccess: ()=>{
            // window.location.reload();
        }
    })
}

</script>

<template>
    <Main :category="category">

        <div class="flex flex-col w-auto justify-center">
            <div class="flex flex-col w-auto items-center justify-center gap-2">
                <div class="flex flex-row w-auto gap-3">
                    <div v-for="catt in category" :key="catt.id">
                        <div>{{ catt.name }}</div>
                    </div>
                </div>
                <div class="flex flex-col w-min">
                    <div class="bg-blue-200 p-2">
                        <div class="font-semibold">Edit Category</div>
                        <select @change="changeInput" v-model="selectedOptionEdit" >
                            <option value="selecione">Selecione a categoria</option>
                            <option v-for="cat in category" :key="cat.id" :value="cat">{{ cat.name }}</option>
                        </select>
                        <div v-if="selectedOptionEdit != 'selecione'" class="flex flex-col mt-2">
                            <input type="text"
                                @input="selectedOptionEdit.value = selectedOptionEdit.name"
                                v-model="selectedOptionEdit.name"
                                />
                            <button @click="editCategory" class="bg-green-400 pt-1 mt-2">Editar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-auto justify-center">
                <div class="flex mt-4 w-auto justify-center">
                    <div class=" bg-blue-200 p-2">
                        <div class="font-semibold">Add Category</div>
                        <form @submit.prevent="save" class="flex flex-col">

                            <input type="text" v-model="form.name" />

                            <div class="font-semibold mt-2">After the field:</div>

                            <select @change="form.cat = selectedOptionAdd" v-model="selectedOptionAdd" >
                                <option v-for="cat in category" :key="cat.id" :value="cat.name">{{ cat.name }}</option>
                            </select>

                            <button class="bg-green-400 pt-1 mt-2">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>

         </div>

    </Main>

</template>
