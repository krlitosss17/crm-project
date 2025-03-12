<template>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Título de la página -->
      <h1 class="text-2xl font-semibold text-gray-900 mb-4">Usuarios</h1>
  
      <!-- Botón para crear un nuevo usuario -->
      <div class="flex justify-between items-center mb-4">
        <!-- Usamos Inertia Link para que la navegación sea fluida sin recargar la página -->
        <inertia-link :href="route('usuarios.create')" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
          Crear Usuario
        </inertia-link>
      </div>
  
      <!-- Tabla que lista a todos los usuarios -->
      <table class="min-w-full bg-white border border-gray-300 shadow-md">
        <thead>
          <tr>
            <!-- Encabezados de la tabla -->
            <th class="px-4 py-2 text-left">Nombre</th>
            <th class="px-4 py-2 text-left">Correo Electrónico</th>
            <th class="px-4 py-2 text-left">Rol</th>
            <th class="px-4 py-2 text-center">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Recorremos todos los usuarios y mostramos sus datos -->
          <tr v-for="user in users" :key="user.id">
            <td class="px-4 py-2">{{ user.name }}</td> <!-- Nombre del usuario -->
            <td class="px-4 py-2">{{ user.email }}</td> <!-- Correo del usuario -->
            <!-- Mostramos los roles del usuario (en caso de que tenga más de uno) -->
            <td class="px-4 py-2">{{ user.roles.map(role => role.name).join(', ') }}</td>
            <td class="px-4 py-2 text-center">
              <!-- Botón para editar al usuario -->
              <inertia-link :href="route('usuarios.edit', user.id)" class="text-blue-500 hover:text-blue-700">
                Editar
              </inertia-link>
              |
              <!-- Botón para eliminar al usuario -->
              <button @click="deleteUser(user.id)" class="text-red-500 hover:text-red-700">
                Eliminar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from "vue";
  import { Inertia } from "@inertiajs/inertia";
  
  export default {
    props: {
      // Recibimos los usuarios desde el controlador
      users: Array,
    },
    methods: {
      // Método para eliminar un usuario
      deleteUser(userId) {
        // Pedimos confirmación antes de eliminar
        if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
          // Realizamos la eliminación usando Inertia.js
          Inertia.delete(route("usuarios.destroy", userId));
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilos personalizados para la tabla y demás elementos */
  </style>
  