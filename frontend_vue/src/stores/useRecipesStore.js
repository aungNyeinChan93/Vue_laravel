import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";


export const useRecipesStore = defineStore('recipes', () => {
    const recipes = ref([]);

    const recipesDataFetch = async () => {
        try {
            const res = await axios.get('/api/recipes');
            recipes.value = res.data.recipes
        } catch (e) {
            console.log(e);
        }
    }

    const recipesByCategory = async (category) => {
        try {
            // if (category === "all") {
            //     const res = await axios.get('/api/recipes');
            //     recipes.value = res.data.recipes
            // } else {
            // }
            const res = await axios.get(`/api/recipes?category=${category}`);
            recipes.value = res.data.recipes
        } catch (error) {
            console.log(e);
        }
    }

    return { recipes, recipesDataFetch, recipesByCategory }
});