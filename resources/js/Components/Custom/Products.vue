<template>
    <div class="max-w-7xl mx-2 md:mx-auto mb-5 flex flex-col gap-5 text-center bg-[#b8c1ec] rounded-md p-2 ">
        <h2 class="text-3xl font-bold text-[#232946] mt-5">Nuestros productos</h2>
        <p class="text-xl text-[#232946]" v-if="products.length === 0">Aun no hay productos</p>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5 text-center m-5">

            <div class="col-span-1" v-for="product in products.slice(0, limite)" :key="product.id">
                <ProductCard :product="product">
                </ProductCard>
            </div>
        </div>
        <div>

            <button v-if="products.length > 0"
                class="uppercase font-bold  text-[#232946] rounded px-4 py-2  bg-[#eebbc3] my-2 shadow-md shadow-gray-400 hover:scale-105 "
                @click="toggleMostar">
                {{ mostrarTodos ? 'Mostrar menos' : 'Mostrar más' }}
            </button>
        </div>

    </div>



    <hr class="mb-5">

</template>

<script setup>

import ProductCard from '@/Components/Custom/ProductCard.vue';
import { ref } from 'vue';


const props = defineProps({
    products: {
        type: Object,
    },
});


const limite = ref(4);


const mostrarTodos = ref(false);

const toggleMostar = () => {

    if (limite.value === 4) {
        limite.value = props.products.length;
        mostrarTodos.value = true;
    } else {
        limite.value = 4;
    }
};

</script>
