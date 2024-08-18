import { defineStore } from "pinia";
import { useCartStore } from "./cartStorage";

export const useProcesoDeCompraStore = defineStore("procesoDeCompra", {


    state: () => ({
        items: [],
        nombre: "",
        apellido: "",
        email: "",
        direccion: "",
        localidad: "",
        codigoPostal: "",
        telefono: "",
        dni: "",
        metodoDeEnvio: "sucursal",
    }),


    actions: {
        setNombre(value) {
            this.nombre = value;
        },

        getNombre() {
            return this.nombre;
        },

        setApellido(value) {
            this.apellido = value;
        },

        getApellido() {
            return this.apellido;
        },
        setEmail(value) {
            this.email = value;
        },

        getEmail() {
            return this.email;
        },
        setDireccion(value) {
            this.direccion = value;
        },

        getDireccion() {
            return this.direccion;
        },  
        setLocalidad(value) {
            this.localidad = value;
        },

        getLocalidad() {
            return this.localidad;
        },
        setCodigoPostal(value) {
            this.codigoPostal = value;
        },

        getCodigoPostal() {
            return this.codigoPostal;
        },
        setTelefono(value) {
            this.telefono = value;
        },

        getTelefono() {
            return this.telefono;
        },
        setDni(value) {
            this.dni = value;
        },

        getDni() {
            return this.dni;
        },
        setMetodoDeEnvio(value) {
            this.metodoDeEnvio = value;
        },

        getMetodoDeEnvio() {
            return this.metodoDeEnvio;
        },





        
    },
})