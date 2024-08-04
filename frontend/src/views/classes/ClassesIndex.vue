<script setup>
import useClasses from '@/composables/classes';
import { onErrorCaptured, onMounted, ref, computed } from 'vue';

const { classes, getClasses } = useClasses()

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
<div v-if="errorMsg">{{ errorMsg }}</div>
<div v-if="isLoading || isClassesEmpty">

<div class="fixed inset-0 flex items-center justify-center bg-gray-50 dark:bg-gray-800">
    <div class="px-3 py-1 text-xs font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse dark:bg-blue-900 dark:text-blue-200">
        Carregando...
    </div>
</div>

</div>
<div v-else>
    <div class="mt-4 flex justify-end mb-4">
        <RouterLink :to="{name: 'ClassesCreate'}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Criar Turma</RouterLink>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-600 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                    <th scope="col" class="px-6 py-3">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr  v-for="schoolClass in classes" :key="schoolClass.id" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-700 border-b dark:border-gray-500">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ schoolClass.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ schoolClass.year }}
                    </td>
                    <td class="px-6 py-4">
                        {{ schoolClass.school_term }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


</div>
</template>