<template>
            <h1 class="text-3xl font-semibold text-[#fffffe] py-10">Carrito de compras</h1>

<div class="flex flex-col w-2/3 justify-center items-center rounded-md py-10 p-5 bg-white shadow-md shadow-gray-500">

   <table class="items-center bg-transparent w-full border-collapse">
       <thead class="bg-[#232946] text-white" >
           <tr>
               <th class="font-bold text-start px-2 py-2">Nombre</th>
               <th class="font-bold text-start px-2 py-2">Precio</th>
               <th class="font-bold text-start px-2 py-2">Unidades</th>
               <th class="font-bold text-start px-2 py-2">Subtotal</th>
               <th class="font-bold text-center px-2 py-2">Acciones</th>
           </tr>
       </thead>
       <tbody class="divide-y border-b-2">
           <tr v-for="(item, index) in store.items" :key="index">
               <td class="  text-start px-2 py-2 capitalize">{{ item.nombre }}</td>
               <td class="  text-start px-2 py-2">${{ item.precio }}</td>
               <td class="  text-start px-2 py-2">
                   <input @change="updateQuantity(item.id, $event.target.value)" min="1" max="5" step="1" name="stock" :id="item.id" type="number" class=" px-1 py-1" v-model="item.cantidad">
               </td>
               <td class="  text-start px-2 py-2">${{ item.precio * item.cantidad }}</td>
               <td class="  text-center px-2 py-2">
                   <button class="uppercase font-bold text-white bg-red-500 rounded px-4 py-2" @click="removeFromCart(item.id)">Eliminar</button>
               </td>
           </tr>
       </tbody>
   </table>

   

<div class="flex items-center gap-5 mt-10 rounded-md ">
   <p class="font-bold text-3xl">Total: $<span class="font-normal">{{ store.totalCart() }}</span></p>
</div>



</div>

    
</template>

<script setup>

import { ref, onMounted, computed } from 'vue';
import { useCartStore } from '@/Stores/cartStorage';

const store = useCartStore();

onMounted(() => {
    store.loadFromLocalStorage();
});




const removeFromCart = (id) => {
    store.removeItem(id);
    store.saveToLocalStorage();
};


const updateQuantity = (id, quantity) => {
    store.updateQuantity(id, quantity);
    store.saveToLocalStorage();
};  



</script>

