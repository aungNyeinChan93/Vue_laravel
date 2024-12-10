<template>
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg text-center">
            <h1 class="text-2xl font-bold sm:text-3xl">Get started Taste!</h1>

            <p class="mt-4 text-gray-500">
                Create Recipes
            </p>
        </div>

        <form @submit.prevent="createRecipe" enctype="multipart/form-data" class="mx-auto mb-0 mt-8 max-w-md space-y-4">

            <div>
                <label for="title" class="sr-only">title</label>
                <div class="relative  mt-3">
                    {{ recipe }}
                    <input v-show="recipe" type="title" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter title" v-model="form.title"  />
                    <input v-show="!recipe" type="title" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Enter title" v-model="form.title" value="" />
                </div>
                <div>
                    <label for="description" class="sr-only">description</label>
                    <div class="relative mt-3">
                        <textarea v-model="form.description" rows="8"
                            class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                            placeholder="Enter description"></textarea>
                    </div>
                </div>

                <div>
                    <select v-model="form.category_id"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm mt-3">
                        <option value="choose" selected>Choose Category</option>
                        <option v-for="category in categoriesStore.categories" :key="category.id" :value="category.id">
                            {{ category.name }}</option>
                    </select>
                </div>

                <div>
                    <input type="file" accept="image/png , image/jpg , image/jpeg" name="photo" v-on:change="upload"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm mt-3">
                </div>

                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-500">
                        No account?
                        <a class="underline" href="#">Sign up</a>
                    </p>

                    <button type="submit"
                        class="inline-block rounded-lg bg-green-500 px-5 py-3 text-sm font-medium text-white my-4">
                        Create
                    </button>

               
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { onMounted, reactive } from 'vue';
import { useCategoryStore } from '@/stores/useCategoryStore';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { defineProps } from 'vue';


const props = defineProps({
    recipe:{
        type:Object
    }
});

const categoriesStore = useCategoryStore();
const router = useRouter();

const form = reactive({
    title: null,
    description: null,
    category_id: 'choose',
    photo: null,
});

const upload = (e) => {
    let file = e.target.files[0];
    if (file) {
        form.photo = file;
    }
}

const createRecipe = async () => {

    const formData = new FormData();
    formData.append('photo', form.photo);
    formData.append('name', 'Recipe Name');
    try {
        const res = await axios.post('/api/recipes/upload', formData);
        form.photo = res.data.path
        // console.log(form.photo);
        
        if (form.photo) {
            const recipe = await axios.post('/api/recipes', form);
            router.push({ name: 'home' })
        }

    } catch (error) {
        console.error('Error uploading recipe:', error);
    }
}

onMounted(() => {
    categoriesStore.categoriesDataFetch();
    console.log(props.recipe.title);
    
});
</script>
