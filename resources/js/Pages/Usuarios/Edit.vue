<template>
    <div>
        <h1 class="text-xl font-bold mb-4">Editar Usuario</h1>

        <!-- Formulario de edición de usuario -->
        <form @submit.prevent="submit">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input v-model="usuario.name" id="name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input v-model="usuario.email" id="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>

            <!-- Roles -->
            <div class="mb-4">
                <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
                <select v-model="usuario.roles" id="roles" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                </select>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Guardar Cambios</button>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { Inertia } from '@inertiajs/inertia';

const route = useRoute();
const router = useRouter();

// Definir variables reactivas
const usuario = ref({
    name: '',
    email: '',
    roles: []
});

const roles = ref([]);

// Cargar los datos del usuario y los roles
onMounted(() => {
    Inertia.get(route('usuarios.show', route.params.id), {}, {
        onSuccess: (data) => {
            usuario.value = data.props.usuario;
            roles.value = data.props.roles;
        }
    });
});

// Enviar el formulario de actualización
const submit = () => {
    Inertia.put(route('usuarios.update', route.params.id), usuario.value);
};
</script>
