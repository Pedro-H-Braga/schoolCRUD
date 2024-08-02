<template>
    <header class="bg-slate-300 py-6">
      <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        <div class="text-lg font-semibold text-gray-800">
          Sistema de Gerenciamento Escolar
        </div>
        <nav class="flex space-x-6">
          <RouterLink to="/" class="text-gray-800 hover:text-gray-600">Turmas</RouterLink>
          <RouterLink to="/about" class="text-gray-800 hover:text-gray-600">Alunos</RouterLink>
        </nav>
      </div>
    </header>
  </template>

<script>
export default {
  name: 'Header',
}
</script>