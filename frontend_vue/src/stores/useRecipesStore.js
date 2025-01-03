import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";


export const useRecipesStore = defineStore('recipes', () => {

    const isloading = ref(true)

    const recipes = ref([]);

    const recipe = ref({});

    const links = ref();

    const prev_page_url = ref('');
    const next_page_url = ref('');




    // all recipes
    const recipesDataFetch = async () => {
        try {
            const res = await axios.get('/api/recipes');
            recipes.value = res.data.recipes
            isloading.value = false;
            links.value = res.data.recipes.links
            prev_page_url.value= res.data.recipes.prev_page_url
            next_page_url.value= res.data.recipes.next_page_url

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
    const recipeData = async (id) => {
        const { data } = await axios.get('api/recipes/' + id);
        recipe.value = data.recipe
    }

    return { links, isloading, recipe, recipes, recipesDataFetch, recipesByCategory, recipeData ,prev_page_url,next_page_url }
});