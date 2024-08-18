<template>
    <h1>Resumen de compra</h1>

    <div class="flex flex-col bg-white w-2/3">
        <div>
            <ul>
                <li><strong>Fecha de compra:</strong> {{ procesoDeCompra.created_at }}</li>
                <div v-for="item in items" :key="item.id">

                    <li><strong>Producto:</strong> {{ item.nombre }}</li>

                </div>
                <li><strong>Total:</strong> {{ procesoDeCompra.total }}</li>
            </ul>
        </div>

        <div>
            <ul>
                <li><strong>Nombre:</strong> {{ procesoDeCompra.nombre }}</li>
                <li><strong>Apellido:</strong> {{ procesoDeCompra.apellido }}</li>
                <li><strong>DNI:</strong> {{ procesoDeCompra.dni }}</li>
                <li><strong>Teléfono:</strong> {{ procesoDeCompra.telefono }}</li>
                <li><strong>Email:</strong> {{ procesoDeCompra.email }}</li>
            </ul>
        </div>

        <div>
            <ul>
                <li><strong>Metodo de envio:</strong> {{ procesoDeCompra.metodoDeEnvio }}</li>
                <li><strong>Dirección:</strong> {{ procesoDeCompra.direccion }}</li>
                <li><strong>Localidad:</strong> {{ procesoDeCompra.localidad }}</li>
                <li><strong>Codigo Postal:</strong> {{ procesoDeCompra.codigoPostal }}</li>
            </ul>

        </div>

    </div>



</template>

<script setup>
import { computed } from 'vue';
import { useProcesoDeCompraStore } from '@/Stores/procesoDeCompraStorage';
import { useCartStore } from '@/Stores/cartStorage';

const procesoDeCompra = useProcesoDeCompraStore();
const store = useCartStore();

const items = computed(() => store.items);


</script>
