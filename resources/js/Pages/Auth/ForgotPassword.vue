<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>


    <Head title="Forgot Password" />
    <div  class="bg-[#232946] flex flex-col justify-center items-center min-h-screen ">

        <div class="bg-[#b8c1ec] rounded-md shadow-md shadow-gray-500 p-10 w-1/3">

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            ¿Olvidaste tu contraseña? No hay problema. Simplemente infórmanos tu dirección de correo electrónico y te
            enviaremos un enlace para restablecer la contraseña que te permitirá elegir una nueva.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="bg-[#eebbc3] text-[#232946] hover:text-white" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Enlace para restablecer la contraseña por correo electrónico
                </PrimaryButton>
            </div>
        </form>

        </div>

    </div>


</template>
