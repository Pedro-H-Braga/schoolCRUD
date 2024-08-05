<script setup>
import useClasses from '@/composables/classes';
import { onErrorCaptured, onMounted, ref, computed } from 'vue';

const { classes, getClasses, destroyClass } = useClasses()

const errorMsg = ref(null);
const isLoading = ref(true);

const isClassesEmpty = computed(() => {
    return classes.value.length === 0;
});

onMounted(async () => {
    try {
        await getClasses();
    } catch (error) {
        errorMsg.value = "Algo de errado ocorreu ao carregar os dados ;(";
    } finally {
        isLoading.value = false; 
    }
})

onErrorCaptured(() => {
    errorMsg.value = "Algo de errado ocorreu ao carregar os dados ;(";
});
</script>

<template>
<div v-if="isLoading || isClassesEmpty">

<div class="fixed inset-0 flex items-center justify-center bg-gray-50 dark:bg-gray-800">
    <div class="px-3 py-1 text-xs font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse dark:bg-blue-900 dark:text-blue-200">
        Carregando...
    </div>
</div>

</div>
<div v-else>
    <div class="flex justify-between items-center mb-4 mt-4">
        <span class="text-2xl font-semibold whitespace-nowrap dark:text-white">Turmas</span>
        <RouterLink :to="{name: 'ClassesCreate'}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Criar Turma</RouterLink>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nome da Turma
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ano da Turma
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Turno Escola
                    </th>
                    <th scope="col" class="px-6 py-3 w-32">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="schoolClass in classes" :key="schoolClass.id" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap dark:text-white">
                        {{ schoolClass.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ schoolClass.year }}
                    </td>
                    <td class="px-6 py-4">
                        {{ schoolClass.school_term }}
                    </td>
                    <td class="px-6 py-4">
                        <RouterLink :to="{name: 'ClassesEdit', params: {id: schoolClass.id}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</RouterLink>
                        <button @click="destroyClass(schoolClass.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remover</button>
                    </td>                   
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>