<template>
  


    <div>
        <input type="radio" id="domicilio" value="domicilio" @change="actualizarMetodoDeEnvio($event)" v-model="envio">
        <label for="domicilio">Domicilio</label>

    </div>

    <div>
        <input type="radio" id="sucursal" value="sucursal" @change="actualizarMetodoDeEnvio($event)" v-model="envio">

        <label for="sucursal">Sucursal</label>

    </div>



    <div v-if="envio == 'domicilio'">



        <form @submit.prevent="submit">


            <div>
                <InputLabel for="direccion" value="Dirección" />
                <TextInput @change="procesoDeCompra.setDireccion(form.direccion)" id="direccion" type="text"
                    class="mt-1 block w-full" v-model="form.direccion" required>
                </TextInput>
                <InputError class="mt-2" :message="form.errors.direccion" />
            </div>

            <div>
                <InputLabel for="localidad" value="Localidad" />
                <TextInput @change="procesoDeCompra.setLocalidad(form.localidad)" id="localidad" type="text"
                    class="mt-1 block w-full" v-model="form.localidad" required>
                </TextInput>
                <InputError class="mt-2" :message="form.errors.localidad" />
            </div>

            <div>
                <InputLabel for="codigoPostal" value="Código postal" />
                <TextInput @change="procesoDeCompra.setCodigoPostal(form.codigoPostal)" id="codigoPostal" type="text"
                    class="mt-1 block w-full" v-model="form.codigoPostal" required>
                </TextInput>
                <InputError class="mt-2" :message="form.errors.codigoPostal" />
            </div>





            <!-- <button type="submit" class="mt-4 uppercase font-bold text-white bg-blue-500 rounded px-4 py-2">Continuar</button> -->


        </form>


    </div>   
    
  
</template>

<script setup>

import { ref , onMounted } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import { useProcesoDeCompraStore } from '@/Stores/procesoDeCompraStorage';
import { text } from '@cloudinary/url-gen/qualifiers/source';



const procesoDeCompra = useProcesoDeCompraStore();

onMounted(() => {
    form.reset('direccion', 'localidad', 'codigoPostal');
    form.direccion = procesoDeCompra.getDireccion();
    form.localidad = procesoDeCompra.getLocalidad();
    form.codigoPostal = procesoDeCompra.getCodigoPostal();
    
});

const envio = ref(procesoDeCompra.getMetodoDeEnvio());
const mostrarFormularioDomicilio = ref(false);
const mostrar = ref(false);


const form = useForm({
    direccion: '',
    localidad: '',
    codigoPostal: '',
});

const actualizarMetodoDeEnvio = (event) => {
    procesoDeCompra.setMetodoDeEnvio(event.target.value);
}



</script>
