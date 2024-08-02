<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Header from './components/Header.vue';
</script>

<template>
  <Header />

  <main class="max-w-7xl mx-auto min-h-screen">
    <RouterView />
  </main>
</template>

