<template>
  <div class="container mx-auto px-10 my-4">
    <RecipeCreateForm :recipe="recipe" />
  </div>
</template>

<script setup>
import RecipeCreateForm from '@/components/RecipeCreateForm.vue';
import { defineProps, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useRecipesStore } from '@/stores/useRecipesStore';

const { recipe, recipes, recipesDataFetch, recipesByCategory, recipeData } = useRecipesStore();
const route = useRoute();
const props = defineProps({ id: { type: Number, required: true, }, }); //that is not work but i don't know ?? so i use params


onMounted(() => {
  // console.log(route.params.id);
  if (route.params.id) {
    recipeData(route.params.id);
  }
});

</script>
