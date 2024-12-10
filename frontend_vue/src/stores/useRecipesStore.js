import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";


export const useRecipesStore = defineStore('recipes', () => {
    const recipes = ref([]);

    const recipe = ref({});

    // all recipes
    const recipesDataFetch = async () => {
        try {
            const res = await axios.get('/api/recipes');
            recipes.value = res.data.recipes
        } catch (e) {
            console.log(e);
        }
    }

    // recipes by category
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

    // single recipe
    const recipeData =async (id)=>{
        const {data} = await axios.get('api/recipes/'+id);
        recipe.value=data.recipe
    }

    return { recipe,recipes, recipesDataFetch, recipesByCategory ,recipeData}
});