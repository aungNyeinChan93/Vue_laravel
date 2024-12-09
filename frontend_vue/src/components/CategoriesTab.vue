<template>
    <div>
        <div class="sm:hidden">
            <label for="Tab" class="sr-only">Tab</label>
            <select id="Tab" class="w-full rounded-md border-gray-200">
                <option value="all">All</option>
                <option v-for="category in categories" :key="category.id" > {{ category.name }} </option>
            </select>
        </div>

        <div class="hidden sm:block">
            <div class="flex gap-6" aria-label="Tabs">
                <span
                    @click="filterCategory('all')"
                    class="shrink-0 rounded bg-green-100 hover:bg-green-300 p-2 text-sm font-medium text-green-600"
                    aria-current="page">
                   All
                </span>
                <span v-for="category in categories" :key="category.id" 
                    @click="filterCategory(category.name)"
                    class="shrink-0 rounded bg-green-100 hover:bg-green-300 p-2 text-sm font-medium text-green-600"
                    aria-current="page">
                    {{ category.name }}
                </span>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { useRecipesStore } from '@/stores/useRecipesStore';


defineProps({
    categories: {
        type: Array
    }
});
const recipeStore = useRecipesStore();

const filterCategory = (category)=>{
    recipeStore.recipesByCategory(category);
}



</script>