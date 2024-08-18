<template>

    <AuthenticatedLayout>
        <Head title="Producto"></Head>
        <div class="flex flex-col max-w-md mx-10 md:mx-auto my-10 justify-center items-center px-5 mt-10">

            <div class="flex justify-center w-full mx-auto   items-center gap-5 px-5">


                

                    <form
                        class="flex flex-col items-center max-w-md mx-auto border border-white bg-[#b8c1ec] rounded-md p-5"
                        @submit.prevent="update()" enctype="multipart/form-data">
                        <div class="flex flex-col items-center border border-white p-2 rounded-md">
                            
                            <img :src="imageUrlState ? imageUrl : product.imagen" class="w-40 h-40 rounded-md"
                                :alt="product.nombre" alt="{{ product.nombre }}">
                                <p class="capitalize font-bold text-2xl text-gray-700  ">Actualizar Imagen</p>
                            <input type="file" ref="imagenInput" @change="imageHandler">
                        </div>



                        <div class="w-full">
                            <InputLabel for="nombre" value="Nombre" />
                            <TextInput id="nombre" type="text" class="mt-1 block w-full" required v-model="form.nombre"
                                autofocus />
                            <InputError class="mt-2" :message="form.errors.nombre" />

                        </div>

                        <div class="w-full">

                            <InputLabel for="descripcion" value="Descripción" />

                            <TextArea id="descripcion" type="text" class="mt-1 block w-full" required
                                v-model="form.descripcion" />
                            <InputError class="mt-2" :message="form.errors.descripcion" />

                        </div>

                        <div class="flex w-full gap-2">
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

                            <div>

                                <InputLabel for="precio" value="Precio" />
                                <input
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    type="number" name="precio" id="precio" v-model="form.precio">
                                <InputError class="mt-2" :message="form.errors.precio" />
                            </div>

                        </div>


                        <div class="flex flex-col my-5 rounded-md border border-white py-2 bg-slate-200 w-full items-center">
                            <h2 class="font-bold text-gray-700  text-2xl my-2">Seleciona la/s categoria/s</h2>

                            <div class="flex flex-wrap gap-2 mx-1 justify-center items-center">
                                <div class="flex items-center gap-1" v-for="categoria in categorias"
                                    :key="categoria.id">

                                    <input type="checkbox" checked :id="categoria.id" name="categorias" :value="categoria.id"
                                    
                                        v-model="form.categoriasSelectas">
                                    <label class="capitalize" :for="categoria.id">{{ categoria.nombre }}</label>

                                </div>
                            </div>

                        </div>


                        <div class="flex items-center gap-2 justify-center mt-4">
                            <button @click="update"
                                class="uppercase font-bold text-[#232946] bg-[#eebbc3] rounded px-4 py-2 hover:scale-105 shadow-md shadow-gray-400 ">Actualizar</button>
                            <a @click.prevent="volver" href="#"
                            class="uppercase font-bold text-[#232946] bg-red-400 rounded px-4 py-2 shadow-md shadow-gray-400 ">Cancelar</a>
                        </div>

                    </form>

                    <div>
                    </div>
                </div>
            </div>
       





    </AuthenticatedLayout>
</template>

<script setup>

import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';




const props = defineProps({
    product: Object,
    categorias: Array
})


const form = useForm({
    nombre: props.product.nombre,
    descripcion: props.product.descripcion,
    stock: props.product.stock,
    precio: props.product.precio,
    categorias: props.product.categories,
    categoriasSelectas: [],
    nueva_imagen: '',
})



const volver = () => {
    window.history.back()
}

const update = () => {
    const id = props.product.id
    form.post(route('product.update', id));
}

const imageUrl = ref(null)
const imageUrlState = ref(false)
const imageHandler = (event) => {
    imageUrl.value = URL.createObjectURL(event.target.files[0])
    form.nueva_imagen = event.target.files[0]
    imageUrlState.value = true
}



</script>
