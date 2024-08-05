<script setup>
import { onMounted, reactive, ref, computed } from 'vue';
import { useRoute } from 'vue-router';
import useStudents from '@/composables/students';
import useClasses from '@/composables/classes';

const { updateStudents, getStudent, student, exceptions } = useStudents()
const { classes, getClasses } = useClasses()

const isSubmitting = ref(false)
const errorMsg = ref(null)
const isLoading = ref(true);
const route = useRoute();

const isClassesEmpty = computed(() => {
    return classes.value.length === 0;
});

const isStudentEmpty = computed(() => {
    return student.value.length === 0;
});

const props = defineProps ({
    id: {
        required: true,
        type: String,
    }
})

onMounted(async () => {
    try {
        await getClasses()
        await getStudent(props.id)
    } catch (error) {
        errorMsg.value = "Algo de errado ocorreu ao carregar os dados ;("
    } finally {
        isLoading.value = false
    }
})

const submitForm = async () => {
    isSubmitting.value = true;

    try {
        await updateStudents(route.params.id);
    } catch (error) {
        errorMsg.value = 'Erro ao enviar o formulário. Tente novamente.';
        console.error("Erro ao enviar o formulário:", error);
    } finally {
        isSubmitting.value = false;
    }
}
</script>

<template>
    <div v-if="isLoading || isClassesEmpty || isStudentEmpty">
        <div class="fixed inset-0 flex items-center justify-center bg-gray-50 dark:bg-gray-800">
            <div class="px-3 py-1 text-xs font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse dark:bg-blue-900 dark:text-blue-200">
                Carregando...
            </div>
        </div>
    </div>    
    <main v-else>
        <div>
            <span class="mt-4 mb-4 flex justify-first self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Edição de Aluno</span>
        </div>
        <div class="mt-10">
            <form @submit.prevent="submitForm" class="max-w-md mx-auto">           
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="name" id="name" v-model="student.name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nome do Aluno</label>
                    <div v-if="exceptions.name">
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops! Campo inválido: </span> {{ exceptions.name }}</p>
                    </div>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="date" name="year" id="year" v-model="student.birth_date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="year" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Aniversário</label>
                    <div v-if="exceptions.birth_date">
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops! Campo inválido: </span> {{ exceptions.birth_date }}</p>
                    </div>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="schoolTerm" class="sr-only">Turno Escolar</label>
                    <select id="schoolTerm" v-model="student.school_class_id" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option class="bg-gray-700 text-white" value="">Selecionar uma Turma</option>
                        <option v-for="schoolClass in classes" :key="schoolClass.id" :value="schoolClass.id" class="bg-gray-700 text-white">{{ schoolClass.name }}</option>
                    </select>
                    <div v-if="exceptions.school_class_id">
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops! Campo inválido: </span> {{ exceptions.school_class_id }}</p>
                    </div>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enviar</button>
            </form>
            <div v-if="isSubmitting" class="fixed inset-0 flex items-center justify-center bg-gray-50 dark:bg-gray-800 z-50">
                <div class="px-3 py-1 text-xs font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse dark:bg-blue-900 dark:text-blue-200">
                    Enviando Formulário...
                </div>
            </div>
        </div>
    </main>
</template>