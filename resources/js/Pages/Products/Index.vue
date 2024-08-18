<template>
    <AuthenticatedLayout>

        <Head title="Productos" />

        <div class="flex flex-col max-w-md mx-10 md:mx-auto my-10 justify-center items-center px-5">
            <h1 class="text-3xl font-semibold capitalize text-[#fffffe]">Administrar productos</h1>
        </div>

        <div class="flex flex-col max-w-md mx-10 md:mx-auto my-10 justify-center items-center px-5">

            <button class="uppercase font-bold text-[#232946] bg-[#eebbc3] rounded px-4 py-2" @click="create">
                Crear un nuevo producto
            </button>
        </div>






        <div
            class="max-w-7xl mx-2 md:mx-auto mb-5 flex flex-col gap-5 text-center rounded-md p-2 transition ease-in duration-1000 ">
            <div class="flex flex-col border-2 border-gray-200 p-5 rounded-md bg-[#b8c1ec]" v-if="createToggle">
                <div>
                    <form class="max-w-md mx-auto border border-white bg-slate-600/50 rounded-md p-5"
                        @submit.prevent="submit" enctype="multipart/form-data">
                        <div>
                            <InputLabel for="nombre" value="Nombre" />
                            <TextInput id="nombre" type="text" class="mt-1 block w-full" v-model="form.nombre" required>
                            </TextInput>
                            <InputError class="mt-2" :message="form.errors.nombre" />
                        </div>

                        <div>
                            <InputLabel for="descripcion" value="Descripción" />
                            <TextArea id="descripcion" type="text" class="mt-1 block w-full" v-model="form.descripcion"
                                required></TextArea>
                            <InputError class="mt-2" :message="form.errors.descripcion" />
                        </div>

                        <div class="flex gap-2">

                            <div class="w-full">
                                <InputLabel for="stock" value="Stock" />
                                <select
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    name="stock" id="stock" v-model="form.stock">
                                    <option value="disponible" selected>Disponible</option>
                                    <option value="no disponible">No Disponible</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.stock" />
                            </div>

                            <div class="w-full">
                                <InputLabel for="precio" value="Precio" />
                                <input
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    type="number" name="precio" id="precio" v-model="form.precio">

                                <InputError class="mt-2" :message="form.errors.precio" />
                            </div>


                        </div>


                        <div class="flex flex-col my-5 rounded-md border border-white py-2 bg-slate-400">
                            <h2 class="font-bold capitalize text-2xl my-2">Categorias</h2>
                            <div class="flex flex-wrap gap-2 mx-1 ">
                                <div class="flex items-center" v-for="category in categories" :key="category.id">

                                    <input class="mr-1" type="checkbox" :id="category.id" name="categorias"
                                        :value="category.id" v-model="form.categorias">
                                    <label id="{{ category.id }}" class="capitalize" :for="category.id">{{
                                        category.nombre }}</label>

                                </div>
                            </div>

                            <InputError class="mt-2" :message="form.errors.categorias" />
                        </div>

                        <div class="w-full overflow-hidden">
                            <input type="file" class="text-sm" name="imagen" id="imagen"
                                @change="form.imagen = $event.target.files[0]">
                        </div>

                        <div class="flex justify-center items-center mt-5">
                            <input class="uppercase w-full rounded-md font-bold text-[#232946] bg-[#eebbc3] px-4 py-2"
                                @click="submit" type="submit">
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- lista de productos -->

        <div
            class="max-w-7xl mx-2 md:mx-auto mb-5 flex flex-col  text-center rounded-md p-2 bg-[#b8c1ec] border border-white ">

            <h2 class="font-bold capitalize text-2xl mt-5">Listado de productos</h2>

            <div class=" md:mx-auto mb-5 flex flex-col gap-5 text-center rounded-md p-2  ">

                <div v-if="products && products.length">
                    <div class="flex flex-col align-middle md:flex-row my-10 justify-center border-2 py-5 rounded-lg items-center px-5 gap-5 bg-[#232946] text-white"
                        v-for="product in products" :key="product.id">
                        <div class="flex flex-col md:flex-row justify-center items-center gap-5">

                            <img class="w-20 h-20 rounded-md" :src="product.imagen" alt="imagen">
                            <h2 class="font-bold capitalize">{{ product.nombre }}</h2>
                            <p class="text-sm">{{ truncate(product.descripcion, 50) }}</p>
                            <p>Precio: <span>{{ product.precio }}</span></p>
                            <p>Stock: <span>{{ product.stock }}</span></p>
                        </div>
                        <div class=" flex gap-5">
                            <a class="text-blue-500" :href="route('product.show', product.id)">Editar</a>
                            <!-- <button class="text-blue-500" @click="updateProduct(product.id)">Editar</button> -->
                            <button class="text-red-500" @click="deleteProduct(product.id)">Eliminar</button>
                        </div>



                    </div>
                </div>
                <p v-else> No hay productos </p>
            </div>
        </div>






    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import { ref } from "vue";

import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from "sweetalert2";




onMounted(() => {
    initFlowbite();
});

const props = defineProps({
    products: {
        type: Object,
    },
    categories: {
        type: Object,
    },
    mensaje: {
        type: String,
    },
});

const createToggle = ref(false);

const create = () => {
    createToggle.value = !createToggle.value;
};

const form = useForm({
    nombre: "",
    descripcion: "",
    imagen: "",
    pulic_id: "",
    stock: "disponible",
    precio: null,
    categorias: [],
});

const submit = () => {
    form.post(route("product.store"), {
        onSuccess: () => {
            form.reset();
            createToggle.value = false;
            Swal.fire({
                icon: 'success',
                title: 'Creado',
                text: 'El producto ha sido creado correctamente',
            })
        },
    })
};

const deleteProduct = (id) => {

    Swal.fire({
        title: '¿Desea eliminar este producto?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('product.destroy', id));
            Swal.fire(
                '¡Eliminado!',
                'El producto ha sido eliminado.',
                'success'
            )
        } else {
            return;
        }
    })



}


const truncate = (text, length) => {
    if (text.length > length) {
        return text.substring(0, length) + '...';
    }
    return text;
}




</script>
