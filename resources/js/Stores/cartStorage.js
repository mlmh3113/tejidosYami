import { defineStore } from "pinia";

export const useCartStore = defineStore("cart", {
    state: () => ({
        items: [],
    }),
    actions: {
        addItem(item) {
            this.items.push(item);
        },
        removeItem(id) {
            this.items = this.items.filter((item) => item.id !== id);
        },
        saveToLocalStorage() {
            localStorage.setItem("cart", JSON.stringify(this.items));
        },
        loadFromLocalStorage() {
            const storedCart = localStorage.getItem("cart");
            if (storedCart) {
                this.items = JSON.parse(storedCart);
            }
    },

    updateQuantity(id, quantity) {
        const item = this.items.find((item) => item.id === id);
        if (item) {
            item.quantity = quantity;
            this.saveToLocalStorage();
        }

    },

    getTotal() {
        return this.items.reduce((total, item) => total + item.precio * item.cantidad, 0);
    },

    getItems() {
        return this.items;
    },

    totalCart() {
        return this.items.reduce((total, item) => total + item.precio * item.cantidad, 0);

    },
    }
});

