<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {ref} from 'vue';
import { Head, useForm, router, usePage } from '@inertiajs/vue3';
import {profilePhoto} from '../../profilePhoto.js';

const inputFile = ref(null);

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    profile_photo: {
        type: String
    }
});
const updateForm = useForm({
    profile_photo: null,
    _method: 'PATCH'
})

function showDialog(event) {
  const file = event.target.files[0];
  console.log(file)
  if (file) {
    updateForm.profile_photo = file;

    updateForm.post('/profile/photo', {  // rota correta
      preserveScroll: true,
      onSuccess: () => {
        updateForm.reset('profile_photo');
        reloadPhoto();
      }
    });
  }
}
function updatePhoto(){
    inputFile.value.click();
}
function deletePhoto(){
    router.delete('profile/deletePhoto', {
        onSuccess: () =>{
            const user = usePage().props.auth.user;
            profilePhoto.profile_photo = user.profile_photo; // força imagem nova 
        }
    });
}

function reloadPhoto(){
    router.reload({
        only: ['auth'], // recarrega só o auth do backend
        onSuccess: () => {
            const user = usePage().props.auth.user;
            profilePhoto.profile_photo = user.profile_photo; // força imagem nova
        }
    })
}

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Profile {{ user }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8 w-1/2 ">

                <div class="flex justify-center h-min bg-white p-4 shadow sm:rounded-lg sm:p-4 mt-10">
                    <div class="flex">
                        <div class="flex flex-col items-center justify-center">
                            <div class="text-gray-900 font-medium">
                            {{$page.props.auth.user.name}}
                            </div>
                            <div class="mt-2">
                                <img class="w-16 h-16 rounded-full"
                                :src="profile_photo"/>
                            </div>
                            <div class="text-xs flex gap-3 mt-2 text-white">
                                <!----------->
                                <button
                                @click="deletePhoto"
                                class=" bg-gray-600 hover:bg-red-600 rounded py-1 px-2">Excluir</button>
                                <!----------->
                                <input type="file"
                                    ref="inputFile"
                                    hidden
                                    @change="showDialog"
                                />
                                <!----------->
                                <button @click="updatePhoto"
                                class=" bg-gray-600 hover:bg-green-600 rounded py-1 px-2">Editar</button>
                                <!----------->
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
