<template>
    <div class="container mx-auto px-10 grid grid-cols-4 gap-6 my-10">
        <UsersComponent v-for="category in testStore.categories" :key="category.id" :category="category"/>


    </div>
</template>

<script setup>

import UsersComponent from '@/components/UsersComponent.vue';
import { onMounted } from 'vue';
import { useTestStore } from '@/stores/useTest';

const testStore = useTestStore();

onMounted(()=>{
    testStore.categoriesDataFetch();
    console.log(testStore.categories);
    
});

</script>

