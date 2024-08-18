<script setup>
import { Head, Link } from '@inertiajs/vue3';
import NavBar from '@/Components/Custom/NavBar.vue';
import Hero from '@/Components/Custom/Hero.vue';
import Products from '@/Components/Custom/Products.vue';
import ProductCard from '@/Components/Custom/ProductCard.vue';
import About from '@/Components/Custom/About.vue';
import ContactForm from '@/Components/ContactForm.vue';
import Slider from '@/Components/Custom/Slider.vue';
import WhatsAppBtn from '@/Components/Custom/WhatsAppBtn.vue';
import Footer from '@/Components/Custom/Footer.vue';


defineProps({
    products: {
        type: Object,
    },
});



</script>



<template>

    <Head title="Home" />

    <NavBar />

    <div class="mb-5">
        <Hero />
    </div>

    <div>
        <Products :products="products" />
    </div>



    <div id="about" class="mb-5 scroll-mt-20 mx-2 md:mx-auto">
        <About class="max-w-7xl mx-auto" />
    </div>

    <hr>

    <div id="contact" class="mb-5 mx-2 max-w-7xl md:mx-auto scroll-mt-20">
        <ContactForm />
    </div>


    <div>
        <Slider />
    </div>

    <div>
        <WhatsAppBtn />
    </div>

    <div>
        <Footer />
    </div>




</template>