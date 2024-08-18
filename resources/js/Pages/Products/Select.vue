<template>
    <Head title="producto" />

    <NavBar />
    <div class="flex justify-center items-center my-10 ">
        <div class="flex flex-col my-10 items-centermax-w-7xl rounded-md border border-white p-3 mx-2 md-mx-0 bg-[#b8c1ec]">

            <img class="rounded-md w-full max-w-md" :src="product.imagen" :alt="product.nombre + '_imagen'">
            <h1 class="text-3xl font-bold text-center mt-2">{{ product.nombre }}</h1>
            <div class="flex flex-col max-w-md gap-1">
            <p class="text-center text-sm my-2">{{ product.descripcion }}</p>
            <hr>
            <p class="text-center text-lg">Stock: {{ product.stock }}</p>
            <hr>
            <p class="text-center text-lg">Precio: {{ product.precio }}</p>
            <hr>

            <div class="flex flex-col gap-5 justify-center items-center pb-5 mx-2  rounded-md"  >
                <h2>Categorias:</h2>
                <div class="flex gap-2 flex-wrap">
                             <a href="#" class="text-white text-sm rounded-md px-4 py-2 hover:scale-105 duration-300 capitalize"
                :class="{ 'bg-red-500': index % 2 == 0, 'bg-blue-500': index % 2 != 0 }"
                v-for="(category , index) in product.categories">{{ category.nombre }}
                   </a>
                </div>
       
         
                
            </div>

            <div class="w-full my-2">
                <a @click.prevent="volver" href="#" class=" font-bold shadow-md shadow-gray-400 text-right block text-sm rounded-md px-4 py-2 bg-[#eebbc3] text-[#232946]  hover:scale-105 duration-300">Volver</a>
            </div>
            
            

            </div>
           
           
        

        </div>
    </div>
    <Footer class="" />
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import NavBar from '@/Components/Custom/NavBar.vue';
import Footer from '@/Components/Custom/Footer.vue';

const props = defineProps({
    product: Object,
    categorias: Array
})

const volver = () => {
    window.history.back()
}


</script>

