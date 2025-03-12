<!-- resources/js/Pages/Usuarios/Edit.vue -->
<script setup>
import { reactive } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";

// Recibir los datos del usuario desde el backend
defineProps({
    user: Object,
});

// Crear formulario reactivo
const form = useForm({
    name: "",
    email: "",
    role: "ejecutivo",
});

// Llenar el formulario con los datos del usuario
form.name = user.name;
form.email = user.email;
form.role = user.role;

// Función para actualizar el usuario
const updateUser = () => {
    Inertia.put(route("usuarios.update", user.id), form, {
        onSuccess: () => {
            alert("Usuario actualizado correctamente");
        },
    });
};
</script>

<template>
    <Layout>
        <div class="container mx-auto p-4">
            <h2 class="text-2xl font-bold mb-4">Editar Usuario</h2>
            <form @submit.prevent="updateUser" class="bg-white p-6 rounded-lg shadow-md">
                <!-- Campo Nombre -->
                <div class="mb-4">
                    <label class="block text-gray-700">Nombre</label>
                    <input v-model="form.name" type="text" class="w-full p-2 border rounded-lg" required />
                </div>

                <!-- Campo Correo -->
                <div class="mb-4">
                    <label class="block text-gray-700">Correo</label>
                    <input v-model="form.email" type="email" class="w-full p-2 border rounded-lg" required />
                </div>

                <!-- Seleccionar Rol -->
                <div class="mb-4">
                    <label class="block text-gray-700">Rol</label>
                    <select v-model="form.role" class="w-full p-2 border rounded-lg">
                        <option value="admin">Administrador</option>
                        <option value="ejecutivo">Ejecutivo</option>
                        <option value="coordinador">Coordinador</option>
                    </select>
                </div>

                <!-- Botón Guardar -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Guardar Cambios
                </button>
            </form>
        </div>
    </Layout>
</template>
