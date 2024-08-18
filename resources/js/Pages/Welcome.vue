<script setup>
import { Head, Link } from '@inertiajs/vue3';
import NavBar from '@/Components/Custom/NavBar.vue';
import Hero from '@/Components/Custom/Hero.vue';


defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});



</script>

<template>
    <Head title="Welcome" />

    <NavBar :canlogin="canLogin" :canregister="canRegister" />

    <div>
        <Hero />
    </div>

    <div>
        productos
    </div>

    <div>
        contacto
    </div>

    <div>
        carrusel
    </div>

    <div>
        footer
    </div>

    

 
</template>
