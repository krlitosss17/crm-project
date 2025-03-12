<template>
    <div class="w-64 bg-gray-800 text-white p-4">
      <!-- Barra lateral con enlaces -->
      <div class="mb-8">
        <h2 class="text-lg font-semibold">Menú</h2>
        <ul>
          <!-- Enlace al Dashboard (puedes dejarlo por ahora como placeholder) -->
          <li>
            <Link :href="route('dashboard')" class="block py-2 px-4 text-gray-300 hover:bg-gray-700">Dashboard</Link>
          </li>
          <!-- Enlace a la sección de Usuarios -->
          <li>
            <Link :href="route('usuarios.index')" class="block py-2 px-4 text-gray-300 hover:bg-gray-700">Usuarios</Link>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { Link } from '@inertiajs/vue3';
  </script>
  
  <style scoped>
  /* Personaliza el estilo de la barra lateral aquí */
  </style>
  