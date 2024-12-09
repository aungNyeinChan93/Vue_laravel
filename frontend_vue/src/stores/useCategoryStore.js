import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useCategoryStore = defineStore('categories',()=>{
    const categories = ref([]);

    const categoriesDataFetch = async()=>{
        const res = await axios.get('api/categories');
        categories.value = res.data.categories
        // console.log(categories.value);
        
    }

    return {categories, categoriesDataFetch}
})