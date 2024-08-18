<template>

    <AuthenticatedLayout>

    <Head title="Categorias" />
    
    <div class="flex flex-col max-w-md mx-10 md:mx-auto my-10 justify-center items-center px-5">
        <h1 class="text-3xl font-semibold capitalize text-white">Administrar categorias</h1>
    </div>
    <div class="flex flex-col justify-center mx-auto rounded-lg items-center gap-5 px-5">
        <button class="uppercase font-bold text-white bg-blue-500 rounded px-4 py-2" @click="create">Crear una nueva categoria</button>

        <div class="flex flex-col border-2 border-gray-200 p-5 rounded-md" v-if="createToggle">
            <div>
                <form @submit.prevent="submit">
                    <div>

                        <!-- <InputLabel for="nombre" value="nombre" /> -->

                        <TextInput id="nombre" type="text" class="mt-1 block w-full" v-model="form.nombre" required
                            autocomplete="nombre" autofocus />

                        <InputError class="mt-2" :message="form.errors.nombre" />
                    </div>
                    <div class="flex items-center gap-2 justify-center mt-4">
                        <button class="capitalize text-sm font-bold text-white bg-blue-500 rounded px-4 py-2"
                            @click="submit">Crear</button>
                        <button class="capitalize text-sm font-bold text-white bg-red-500 rounded px-4 py-2"
                            @click="cancelBtn">Cancelar</button>
                    </div>
                </form>


            </div>


        </div>


    </div>

    <div
        class="flex flex-col max-w-md mx-10 md:mx-auto my-10 justify-center border-2 py-5 rounded-lg items-center px-5 gap-5 bg-[#b8c1ec]">
        <h1 class="text-3xl font-semibold text-[#232946] ">Categorias</h1>
        <div class="flex flex-col w-full mx-auto gap-2" v-if="categories && categories.length">
            <div class="flex w-full justify-between bg-gray-200 rounded-md items-center gap-5 px-5"
                v-for="category in categories" :key="category.id">
                <p class="text-xl capitalize">{{ category.nombre }}</p>
                <div class="flex gap-5">

                    <button class="text-blue-500" @click="editCategory(category)">Editar</button>
                    <button class="text-red-500" @click="deleteCategory(category.id)">Eliminar</button>
                </div>
            </div>
        </div>

        <p v-else> No hay categorias </p>
        <p v-if="mensaje">{{ mensaje }}</p>

    </div>

 

<div v-if="editModal" class="fixed inset-0 z-50 flex justify-center w-full h-screen  mx-auto bg-slate-700/30  items-center gap-5 px-5">


<div class="bg-white p-10 rounded-lg">

    <form @submit.prevent="update" >

        <div>
            <!-- <InputLabel for="nombre" value="Nombre" /> -->
            <TextInput id="nombre" type="text" class="mt-1 block w-full" v-model="form.nombre" required autofocus  />
                

            <InputError class="mt-2" :message="form.errors.nombre" />
        </div>

        <div class="flex items-center gap-2 justify-center mt-4">
            <button class="ms-4 uppercase font-bold text-white bg-blue-500 rounded px-4 py-2"
                @click="update()">Actualizar</button>
            <button class="ms-4 uppercase font-bold text-white bg-red-500 rounded px-4 py-2"
                @click="cancelBtn">Cancelar</button>
        </div>

    </form>

</div>
                      
</div>

    
  

    

    </AuthenticatedLayout>  

</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';
import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from "sweetalert2";

import { usePage } from '@inertiajs/vue3';




onMounted(() => {
    initFlowbite();
})

defineProps({
    categories: {
        type: Object
    },
    mensaje: {
        type: String
    }
});

const form = useForm({
    nombre: '',
});

const editModal = ref(false);


const submit = () => {
    form.post(route('category.store'),{
        onSuccess: () => {
            form.reset();
            createToggle.value = false;
            Swal.fire({
                icon: 'success',
                title: 'Categoria creada correctamente',
                showConfirmButton: false,
                timer: 1500
            })
        }
    });
    
};

const deleteCategory = (id) => {

    Swal.fire({
        title: '¿Desea eliminar esta categoria?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('category.destroy', id), {
                onSuccess: () => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
        } else {
            return;
        }
    })


};


const createToggle = ref(false);
const create = () => {
    createToggle.value = true;
}



const editCategory = (category) => {
    editModal.value = true;
    form.nombre = category.nombre;
    
}

const cancelBtn = () => {
    editModal.value = false;
    createToggle.value = false;
    form.reset();
}

const update = () => {
form.put(route('category.update', selected.value.id), {
    onSuccess: () => {
        editModal.value = false;
        form.reset();
    }
});
   
}

</script>
