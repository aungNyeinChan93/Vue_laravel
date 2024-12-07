
import axios from 'axios';
import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useTestStore = defineStore('test', () => {
    const categories = ref([]);
    const categoriesDataFetch = async ()=>{
        const res = await axios.get('http://127.0.0.1:8000/api/categories');
        categories.value = res.data.categories;
    }
    return {categories, categoriesDataFetch}
})
