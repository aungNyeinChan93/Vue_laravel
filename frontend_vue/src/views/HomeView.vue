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
      <RecipeCard v-for="recipe in recipesStore.recipes.data" :key="recipe.id" :recipe="recipe" :id="recipe.id" />
    </section>
  </div>
</template>

<script setup>
import RecipeCard from '@/components/RecipeCard.vue';
import { useRecipesStore } from '@/stores/useRecipesStore';
import { onMounted } from 'vue';
import CategoriesTab from '@/components/CategoriesTab.vue';
import { useCategoryStore } from '@/stores/useCategoryStore';
const recipesStore = useRecipesStore();
const categoriesStore = useCategoryStore();

onMounted(()=>{
  recipesStore.recipesDataFetch();
  // console.log(recipesStore.recipes);
  categoriesStore.categoriesDataFetch();
});

</script>
