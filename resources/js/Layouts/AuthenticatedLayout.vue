<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import Sidebar from '@/components/Sidebar.vue';

// Estado reactivo para la barra lateral
const sidebarVisible = ref(true);

// Función para alternar la visibilidad de la barra lateral
const toggleSidebar = () => {
    sidebarVisible.value = !sidebarVisible.value;
};

// Estado para la fecha actual
const currentDate = ref('');

onMounted(() => {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    currentDate.value = now.toLocaleDateString('es-ES', options);
});
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Barra de navegación superior -->
        <nav class="bg-white border-b border-gray-200 shadow-sm px-6 py-3 flex justify-between items-center">
            <!-- Sección izquierda (Botón menú y Logo) -->
            <div class="flex items-center">
                <!-- Botón para mostrar la barra lateral cuando está oculta -->
                <div class="relative">
                    <button 
                        v-if="!sidebarVisible" 
                        @click="toggleSidebar" 
                        class="p-1 rounded-md text-gray-600 hover:bg-gray-200 relative group"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <!-- Texto emergente "Abrir menú" (ahora en la parte inferior) -->
                        <span class="absolute left-1/2 transform -translate-x-1/2 top-7 bg-gray-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                            Abrir menú
                        </span>
                    </button>
                </div>
                
                <!-- Logo -->
                <Link :href="route('dashboard')" class="ml-4">
                    <img src="/images/logo.png" alt="Logo Grupo Emel Vida" class="w-28 h-auto" />
                </Link>
            </div>

            <!-- Sección derecha (Fecha, usuario y cerrar sesión) -->
            <div class="flex items-center space-x-4 text-gray-700 text-sm font-medium">
                <span>{{ currentDate }}</span> <!-- Fecha actual -->
                <span>Sesión iniciada por <strong class="uppercase">{{ $page.props.auth.user.name }}</strong></span> <!-- Usuario en negritas y mayúsculas -->
                <!-- Botón de "Cerrar sesión" -->
                <Link 
                    :href="route('logout')" 
                    method="post" 
                    as="button" 
                    class="px-3 py-1 text-xs rounded-md bg-red-600 text-white font-medium hover:bg-red-700 transition"
                >
                    Cerrar sesión
                </Link>
            </div>
        </nav>

        <!-- Contenido principal con barra lateral -->
        <div class="flex min-h-screen bg-gray-100">
            <!-- Barra lateral -->
            <div 
                class="fixed top-0 left-0 h-screen w-64 bg-gray-900 text-white shadow-md transform transition-transform duration-300 ease-in-out"
                :class="{'-translate-x-full': !sidebarVisible, 'translate-x-0': sidebarVisible}"
            >
                <div class="p-4 flex justify-start">
                    <!-- Botón para cerrar la barra lateral -->
                    <button 
                        @click="toggleSidebar" 
                        class="p-1 rounded-md bg-red-500 text-white hover:bg-red-600 transition relative group"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <!-- Texto emergente "Ocultar menú" (ahora en la parte inferior) -->
                        <span class="absolute left-1/2 transform -translate-x-1/2 top-7 bg-gray-900 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                            Ocultar menú
                        </span>
                    </button>
                </div>

                <!-- Aquí se agregarán los menús y submenús -->
                <Sidebar />
            </div>

            <!-- Contenido principal -->
            <div class="flex-1 ml-64 transition-all duration-300 ease-in-out" :class="{'ml-0': !sidebarVisible}">
                <main class="p-6">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
