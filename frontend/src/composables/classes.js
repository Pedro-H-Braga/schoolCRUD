import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

axios.defaults.baseURL = "http://localhost:8000/api/"

export default function useClasses() {
    const classes = ref([])
    const schoolClass = ref([])
    const exceptions = ref([])
    const router = useRouter()

    // index
    const getClasses = async () => {
        const response = await axios.get("classes")       
        classes.value = response.data
    }

    // show
    const getClass = async (id) => {
        const response = await axios.get("classes/" + id)
        schoolClass.value = response.data
    }

    // create
    const storeClass = async (data) => {
        try {
            await axios.post("classes", data)
            await router.push({name: "ClassesIndex"})
        } catch (error) {
            if(error) {
                exceptions.value = error.response.data.errors
                console.error(error)
            }
        }
    }

    // edit
    const updateClass = async (id) => {
        try {
            await axios.patch("classes/" + id, schoolClass.value)
            await router.push({name: "ClassesIndex"})
        } catch (error) {
            if(error) {
                exceptions.value = error.response.data.errors
                console.error(error)
            }
        }
    }

    // delete
    const destroyClass = async (id) => {
        const message = "Você tem certeza?"
        if(!window.confirm(message)) {
            return
        }

        await axios.delete("classes/" + id)
        await getClasses()
    }

    return {
        classes,
        schoolClass,
        exceptions,
        getClasses,
        getClass,
        storeClass,
        updateClass,
        destroyClass,
    }
}