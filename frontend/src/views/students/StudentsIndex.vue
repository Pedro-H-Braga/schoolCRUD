<script setup>
import useStudents from '@/composables/students';
import { onErrorCaptured, onMounted, ref, computed } from 'vue';

const { students, getStudents, destroyStudents } = useStudents()

const errorMsg = ref(null);
const isLoading = ref(true);

const formatDate = (date) => {
    if (!date) return '';
    const [year, month, day] = date.split('-');
    return `${day}/${month}/${year}`;
};

const isStudentsEmpty = computed(() => {
    return students.value.length === 0;
});

onMounted(async () => {
    try {
        await getStudents();
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
<div v-if="isLoading || isStudentsEmpty">

<div class="fixed inset-0 flex items-center justify-center bg-gray-50 dark:bg-gray-800">
    <div class="px-3 py-1 text-xs font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse dark:bg-blue-900 dark:text-blue-200">
        Carregando...
    </div>
</div>

</div>
<div v-else>
    <div class="flex justify-between items-center mb-4 mt-4">
        <span class="text-2xl font-semibold whitespace-nowrap dark:text-white">Alunos</span>
        <RouterLink :to="{name: 'StudentsCreate'}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Criar Aluno</RouterLink>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nome do Aluno
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aniversário
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Turma
                    </th>
                    <th scope="col" class="px-6 py-3 w-32">
                        <!-- Ações -->
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr  v-for="student in students" :key="student.id" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap dark:text-white">
                        {{ student.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ formatDate(student.birth_date) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ student.school_classes.name }}
                    </td>
                    <td class="px-6 py-4">
                        <RouterLink :to="{name: 'StudentsEdit', params: {id: student.id}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</RouterLink>
                        <button @click="destroyStudents(student.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remover</button>
                    </td>                   
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<!-- 
[
  {
    "id": 2,
    "name": "Pedro Paulo",
    "email": "pedro.paulo@example.com",
    "birth_date": "2002-04-17",
    "enable": true,
    "created_at": "2024-08-01T22:20:35.000000Z",
    "updated_at": "2024-08-01T22:20:35.000000Z",
    "deleted_at": null,
    "school_class_id": 3,
    "school_classes": {
      "id": 3,
      "name": "Turma C",
      "year": 2021,
      "school_term": "noturno",
      "enable": false,
      "created_at": "2024-08-01T19:04:35.000000Z",
      "updated_at": "2024-08-01T19:04:35.000000Z",
      "deleted_at": null
    }
  }
]
-->