<template>

<Head title="Ingresa tus datos" />

<h1 class="text-3xl font-semibold text-[#fffffe] py-10">Ingresa tus datos</h1>

<div class="flex flex-col w-2/3 justify-center items-center rounded-md py-10 p-5 bg-white shadow-md shadow-gray-500">


    <form @submit.prevent="submit">

        <div>

            <InputLabel for="name" value="Nombre" />
            <TextInput
            @change="procesoDeCompra.setNombre(form.name)"
            id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="off" />
            <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <div>

            <InputLabel for="surname" value="Apellido" />
            <TextInput 
            @change="procesoDeCompra.setApellido(form.surname)" 
            id="surname" type="text" class="mt-1 block w-full" v-model="form.surname" required  autocomplete="off"/>
            <InputError class="mt-2" :message="form.errors.surname" />
        </div>

        <div>

            <InputLabel for="dni" value="DNI" />
            
            <TextInput
            @change="procesoDeCompra.setDni(form.dni)"
            id="dni" type="text" class="mt-1 block w-full" v-model="form.dni" required  autocomplete="off"/>
            <InputError class="mt-2" :message="form.errors.dni" />

        </div>

        <div class="mt-4">

            <InputLabel for="email" value="Email" />
            <TextInput
            @change="procesoDeCompra.setEmail(form.email)"
            id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="off"/>
            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">

            <InputLabel for="phone" value="Teléfono" />
            <TextInput
            @change="procesoDeCompra.setTelefono(form.phone)"
            id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required autocomplete="off"/>
            <InputError class="mt-2" :message="form.errors.phone" />
        </div>




        <!-- <button type="submit" class="mt-4 uppercase font-bold text-white bg-blue-500 rounded px-4 py-2">Continuar</button> -->


    </form> 







</div>

</template>

<script setup>
import { Head , useForm } from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import { ref , onMounted } from "vue";
import { useProcesoDeCompraStore } from '@/Stores/procesoDeCompraStorage';

const procesoDeCompra = useProcesoDeCompraStore();

onMounted(() => {
    form.reset('name', 'surname', 'dni', 'email', 'phone');
    form.name = procesoDeCompra.getNombre();
    form.surname = procesoDeCompra.getApellido();
    form.dni = procesoDeCompra.getDni();
    form.email = procesoDeCompra.getEmail();
    form.phone = procesoDeCompra.getTelefono();
});






const props = defineProps({
    cart: Object    
})


const form = useForm({
    name: '',
    surname: '',
    dni: '',
    email: '',
    phone: '',
});

</script>
