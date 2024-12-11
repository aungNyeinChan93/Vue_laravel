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
                    <input type="title" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
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
                    <img v-if="recipe.photo" :src="'http://localhost:8000/' + recipe.photo" alt="rec"
                        class="w-50 rounded mx-auto my-3">
                    <input type="file" accept="image/png , image/jpg , image/jpeg" name="photo" @change="upload"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm mt-3">
                </div>

                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-500">
                        No account?
                        <a class="underline" href="#">Sign up</a>
                    </p>

                    <button v-if="!recipe.id" type="submit"
                        class="inline-block rounded-lg bg-green-500 px-5 py-3 text-sm font-medium text-white my-4">
                        Create
                    </button>

                    <button v-else type="submit"
                        class="inline-block rounded-lg bg-green-500 px-5 py-3 text-sm font-medium text-white my-4">
                        Update
                    </button>
                </div>
                <div class="w-full">
                    <router-link to="/" class="text-green-500 py-3 text-xl">
                        Back
                    </router-link>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { onMounted, reactive } from 'vue';
import { useCategoryStore } from '@/stores/useCategoryStore';
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';
import { defineProps } from 'vue';



const props = defineProps({
    recipe: {
        type: Object
    }
});

const categoriesStore = useCategoryStore();
const router = useRouter();
const route = useRoute();

const form = reactive({
    title: props.recipe.title,
    description: props.recipe.description,
    category_id: props.recipe.id ? props.recipe.category_id : 'choose',
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
    // formData.append('name', 'Recipe Name');

    try {

        if (route.params.id) {
            // console.log('have', route.params.id, form);
            const res = await axios.post('/api/recipes/upload', formData); //file upload
            form.photo = res.data.path

            if (form.photo) {
                const { data } = await axios.put(`/api/recipes/${route.params.id}`, form);
                router.push({ name: 'home' })
            }

        } else {
            const res = await axios.post('/api/recipes/upload', formData); //file upload
            form.photo = res.data.path

            if (form.photo) {
                const recipe = await axios.post('/api/recipes', form);
                router.push({ name: 'home' })
            }
        }
    } catch (error) {
        console.error('Error uploading recipe:', error);
    }
}


onMounted(() => {
    categoriesStore.categoriesDataFetch();
    // console.log(props.recipe);
});
</script>
