<template>

    <Head title="Cart" />

    <NavBar />

    {{ paso }}


        
<main class="flex flex-col w-full h-screen justify-start items-center">

   

    <ProductCard v-if="paso == 1"  ></ProductCard>  

    <PersonalData  v-if="paso == 2"   ></PersonalData>
    
    <DeliveryMethod  v-if="paso == 3"  ></DeliveryMethod>

    <ResumenDeCompra  v-if="paso == 4"  ></ResumenDeCompra>





    
    <div class="flex w-2/3 justify-between px-5 bg-white rounded-md mt-5 py-5 ">
        <button class="uppercase font-bold text-white bg-blue-500 rounded px-4 py-2 " :class="paso == 1 ? 'invisible' : ''  " @click="prevStep">Volver</button>

        <button v-if="paso < 4" class="uppercase font-bold text-white bg-blue-500 rounded px-4 py-2 "    @click="nextStep">Continuar</button>

        <button v-if="paso == 4" class="uppercase font-bold text-white bg-blue-500 rounded px-4 py-2 " @click="FinalizarCompra" >Finalizar compra</button>
    </div>
    
   
</main>





</template>

<script setup>
import NavBar from '@/Components/Custom/NavBar.vue';

import ProductCard from '@/Pages/Cart/ProductsCart.vue';
import PersonalData from '@/Pages/Cart/PersonalData.vue';
import DeliveryMethod from './DeliveryMethod.vue';
import ResumenDeCompra from './ResumenDeCompra.vue';
import { Head , router } from '@inertiajs/vue3';
import { ref , onMounted } from 'vue';
import { useProcesoDeCompraStore } from '@/Stores/procesoDeCompraStorage';
import { useCartStore } from '@/Stores/cartStorage';


const cart = ref([]);
const paso = ref(1);

onMounted(() => {
    cart.value = JSON.parse(localStorage.getItem('cart'));
})

const nextStep = () => {
    if (paso.value < 4) {
        paso.value++;
    }
}

const prevStep = () => {
    if (paso.value > 1) {
        paso.value--;
    }
}

const FinalizarCompra = () => {
    const productos = useCartStore();
    const procesoDeCompra = useProcesoDeCompraStore();

    const compra = {
    
        nombre: procesoDeCompra.getNombre(),
        apellido: procesoDeCompra.getApellido(),
        dni: procesoDeCompra.getDni(),
        email: procesoDeCompra.getEmail(),
        telefono: procesoDeCompra.getTelefono(),
        direccion: procesoDeCompra.getDireccion(),
        metodoDeEnvio: procesoDeCompra.getMetodoDeEnvio(),
        total: productos.getTotal(),
        items: productos.getItems()
    }

    router.post(route('cart.store'),JSON.stringify(compra),{
        onSuccess: () => {
            alert('Gracias por tu compra')
        }}
    );



    
}




</script>

