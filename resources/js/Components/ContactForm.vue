<template>
    <div class="flex flex-col gap-5 md:grid md:grid-cols-2 md:space-x-5 min-w-full py-3 md:py-0 bg-[#b8c1ec] rounded-lg mb-20 mt-10 shadow-md shadow-gray-500 ">
        <div class="flex flex-col justify-center items-center  md:col-span-1 text-start gap-3 md:relative">
            <img class="hidden md:flex w-full h-full rounded-s-lg object-cover" src="../../../public/images/hero-1.png" alt="">
            <div class="md:absolute md:top-1/2 md:left-1/2 md:-mt-5 md:ml-4 md:h-fit md:w-fit">
                 <h1  class="text-3xl font-bold self-center text-white">Consultas</h1>
            <p class="text-white text-2xl self-center">Enviame tu pregunta</p>
            </div>
           
        </div>
        <div class="flex flex-col px-5 md:col-span-1 justify-center">
               <form class="text-white my-5"  @submit.prevent="submit">
                <h2 class="text-2xl text-white mb-2 hidden"></h2>
        <div>
            

            <TextInput
            
                id="name"
                type="text"
                class="mt-1 block w-full "
                v-model="form.name"
                required
                autocomplete="name"
                placeholder="Nombre"
            />

            <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <div>
           

            <TextInput
                id="email"
                type="text"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autocomplete="email" 
                placeholder="Correo electronico"  
            />

            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class=" mt-2">
            

            <TextInput
                id="phone"
                type="text"
                class="mt-1 block w-full"
                v-model="form.phone"
                required  
                autocomplete="phone"
                placeholder="Numero de Whatsapp"
            />

            <InputError class="mt-2" :message="form.errors.phone" />
        </div>
        <div class=" mt-2">
           

            <TextArea
                id="msg"
                class="mt-1 block w-full"
                v-model="form.msg"
                required
                rows="5"
                autocomplete="msg"
                name="msg"
                placeholder="¿Como podemos ayudar?"
            />


            <InputError class="mt-2" :message="form.errors.msg" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton class="ms-4 bg-[#eebbc3]" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                <p class="text-[#232946]">Enviar</p>
            </PrimaryButton>
        </div>
        </form>
        </div>
    </div>
 

</template>

<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue'; 
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    msg: ''  
});

const submit = () => {
    form.post(route('contact.store',form));
};


</script>

