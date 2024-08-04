<script setup>
import useClasses from '@/composables/classes';
import { onErrorCaptured, onMounted, ref } from 'vue';

const { classes, getClasses } = useClasses()

const errorMsg = ref(null);
const isLoading = ref(true);


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
<Suspense>
    <template #default>
        <div>
            <div v-if="!isLoading">
                <RouterLink :to="{name: 'ClassesCreate'}">Adicionar uma Turma</RouterLink>
            </div>
            <b>Classes:</b>
            <ul>
                <hr>
                <tr 
                v-for="schoolClass in classes" 
                :key="schoolClass.id">
                    <td>{{ schoolClass.name }}</td>
                    <td>{{ schoolClass.year }}</td>
                    <td>{{ schoolClass.school_term }}</td>
                </tr>
                <hr>
            </ul>
        </div>
    </template>
    <template #fallback>Carregando...</template>
</Suspense>
</template>