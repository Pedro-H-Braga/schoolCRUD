import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

axios.defaults.baseURL = "http://localhost:8000/api/"

export default function useStudents() {
    const students = ref([])
    const student = ref([])
    const exceptions = ref([])
    const router = useRouter()

    // index
    const getStudents = async () => {
        const response = await axios.get("students")       
        students.value = response.data
    }

    // show
    const getStudent = async (id) => {
        const response = await axios.get("students/" + id)
        student.value = response.data
    }

    // create
    const storeStudents = async (data) => {
        try {
            await axios.post("students", data)
            await router.push({name: "StudentsIndex"})
        } catch (error) {
            if(error) {
                exceptions.value = error.response.data.errors
                console.error(error)
            }
        }
    }

    // edit
    const updateStudents = async (id) => {
        try {
            await axios.patch("students/" + id, student.value)
            await router.push({name: "StudentsIndex"})
        } catch (error) {
            if(error) {
                exceptions.value = error.response.data.errors
                console.error(error)
            }
        }
    }

    // delete
    const destroyStudents = async (id) => {
        const message = "Você tem certeza?"
        if(!window.confirm(message)) {
            return
        }

        await axios.delete("students/" + id)
        await getStudents()
    }

    return {
        students,
        student,
        exceptions,
        getStudents,
        getStudent,
        storeStudents,
        updateStudents,
        destroyStudents,
    }
}