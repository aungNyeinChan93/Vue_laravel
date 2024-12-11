<template>
  <div class="min-w-full h-screen px-10 my-5">
    <!-- bunner section -->
    <section class="flex justify-between px-4">
      <span class="text-4xl text-green-500 ">Recipes</span>
      <a class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring" href="#">
        <span class="absolute inset-0 border border-green-600 group-active:border-green-500"></span>
        <span
          class="block border border-green-600 bg-green-600 px-12 py-3 transition-transform active:border-green-500 active:bg-green-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
          <router-link :to="{ name: 'about' }">Add Recipe</router-link>
        </span>
      </a>
    </section>
    <!-- category list section -->
    <div class="flex justify-center items-center my-6">
      <CategoriesTab :categories="categoriesStore.categories" />
    </div>
    <!-- recipes card section -->
    <section class="my-4 grid lg:grid-cols-4 gap-4">

      <template v-if="!recipesStore.isloading">
        <RecipeCard v-for="recipe in recipesStore.recipes.data" :key="recipe.id" :recipe="recipe" :id="recipe.id" />
      </template>

      <template v-else>
        <div v-for="(v, index) in Array(12)" :key="index" class="animate-pulse">

          <div class="aspect-square w-full rounded object-cover bg-slate-500"></div>

          <div class="mt-3 bg-slate-500">
            <h3 class="font-medium text-gray-900 group-hover:underline group-hover:underline-offset-4 bg-slate-500">

            </h3>
            <p class="mt-1 text-sm text-gray-500 bg-slate-500"></p>
          </div>
        </div>
      </template>

    </section>

    <div class="w-full py-2 text-center flex justify-center item-center px-2  ">
      <div v-for="link in recipesStore.links" :key="link.label">
        <button v-if="link.label.includes('Previous')" @click="recipePaginate(recipesStore.prev_page_url)"
          class='mx-4 bg-gray-200 rounded-sm py-1 px-2'>Previous</button>
        <button v-else-if="link.label.includes('Next')" @click="recipePaginate(recipesStore.next_page_url)"
          class='mx-4 bg-gray-200 rounded-sm py-1 px-2'>Next</button>
        <button v-else :class="{ 'bg-green-200': currentPage == link.label }" @click="recipePaginate(link.url)"
          class="px-2 py-1 bg-green-500 hover:bg-green-300 mx-1 rounded-sm ">{{ link.label }}</button>
      </div>
    </div>

  </div>
</template>

<script setup>

import RecipeCard from '@/components/RecipeCard.vue';
import { useRecipesStore } from '@/stores/useRecipesStore';
import { onMounted, ref } from 'vue';
import CategoriesTab from '@/components/CategoriesTab.vue';
import { useCategoryStore } from '@/stores/useCategoryStore';
import axios from 'axios';

const recipesStore = useRecipesStore();
const categoriesStore = useCategoryStore();
const currentPage = ref('')



const recipePaginate = async (url) => {
  try {
    let pageNumber = url.split('page=')[1];
    currentPage.value = pageNumber
    const { data } = await axios.get(url)
    // console.log(data);
    recipesStore.recipes = data.recipes
    recipesStore.next_page_url = data.recipes.next_page_url
    recipesStore.prev_page_url = data.recipes.prev_page_url
  } catch (error) {
    console.log(error);

  }
}

onMounted(() => {
  recipesStore.recipesDataFetch();
  categoriesStore.categoriesDataFetch();

});

// console.log(recipesStore.links);  
// console.log(recipesStore.recipes);
// console.log(recipesStore.next_page_url);
// console.log(prev_page_url.value,next_page_url.value);
// console.log(recipesStore.prev_page_url);

</script>
