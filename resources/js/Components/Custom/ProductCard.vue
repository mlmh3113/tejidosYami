<template>

    <div class="flex flex-col bg-[#121629] shadow-md shadow-gray-400 rounded-lg mx-1 hover:scale-105 duration-300 h-full     " >
        
    <a :href="route('product.select',product.id)" class="hover:cursor-pointer">
       <div class=" overflow-hidden ">
        <img class="rounded-t-lg h-48 object-cover w-full " :src="product.imagen" alt="">
       </div>
        

       <div class="flex flex-col items-center mx-2 mb-2 text-[#fffffe]">
           <h2 class="text-2xl my-2 capitalize font-bold">{{ product.nombre }}</h2>
           <p class="text-sm text-pretty-justify text-[#fffffe] ">{{truncate(product.descripcion,100)  }}</p>
           <p class="font-bold">Precio: <span class="text-[#fffffe] text-sm">${{ product.precio }}</span></p>
           <p class="font-bold">Stock: <span class="text-[#fffffe] text-sm capitalize">{{ product.stock }}</span></p>

       </div>
</a>

           <div> 
            <button @click="addToCart(product)" v-if="product.stock=='disponible'" class="uppercase font-bold text-white bg-blue-500 rounded px-4 py-2 mb-2">Agragar al carrito</button>
            <p v-else class="uppercase font-bold text-white bg-red-500 rounded px-4 py-2">Sin Stock</p>
           </div>
    </div>
    
</template>

<script setup>
import { useCartStore } from '@/Stores/cartStorage.js';
import { ref, onMounted } from 'vue';



const cartStore = useCartStore();

onMounted(() => {
    cartStore.loadFromLocalStorage();
})

defineProps({
    product: Object 
});



const truncate = (text, length) => {
    if (text.length > length) {
        return text.substring(0, length) + '...';
    }
    return text;
}


const addToCart = (product) => {
    const producto = product;
    producto.cantidad = 1;

    const cart = cartStore.items || [];

    const itemExist = cart.find(item => item.id === product.id);
    if (!itemExist) {
        cartStore.addItem(product);
        cartStore.saveToLocalStorage();
    }
        
    // } else {
    //     itemExist.cantidad++;
    //     cartStore.saveToLocalStorage();
    // }
    
}

</script>

