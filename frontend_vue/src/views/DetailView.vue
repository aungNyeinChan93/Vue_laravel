<template>
    <section class="container px-10 mx-auto my-6">
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:items-center md:gap-8">
                <div>
                    <div class="max-w-lg md:max-w-none">
                        <h2 class="text-4xl my-3 font-semibold text-gray-900 ">
                            {{ recipe.title }}
                        </h2>

                        <h4 v-if="recipe.category" class="text-2xl text-green-700 font-semibold ">
                            {{ recipe?.category.name }}
                        </h4>
                        

                        <p class="mt-4 text-gray-700">
                            {{ recipe.description }}
                        </p>



                        <button class="px-4 py-1 mt-4 rounded-md bg-green-500 hover:bg-green-300 ">
                            <router-link :to="{ name: 'home' }">Back</router-link>
                        </button>
                    </div>
                </div>

                <div>
                    <img :src="'http://localhost:8000/'+recipe.photo" class="rounded" alt="" />
                </div>
            </div>
        </div>
    </section>
</template>


<script setup>
import axios from 'axios';
import { defineProps, onMounted, ref } from 'vue';

const props = defineProps({
    id: {
        type: Number
    }
});
console.log(props.id);

const recipe = ref({});

const recipeData = async () => {
    const res = await axios.get('/api/recipes/' + props.id)
    recipe.value = res.data.recipe
    console.log(recipe.value);   
}

onMounted(() => {
    recipeData();
});

</script>