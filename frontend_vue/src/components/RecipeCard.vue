<template>
    <router-link :to="{ name: 'recipeDetail',params:{id:recipe.id}  }" class="group block">
        <img :src="'http://localhost:8000/'+recipe.photo"
            alt="" class="aspect-square w-full rounded object-cover" />

        <div class="mt-3">

            <h3 class="font-medium text-gray-900 group-hover:underline group-hover:underline-offset-4">
                {{ recipe.title }}
            </h3>

            <p class="mt-1 text-sm text-gray-700">{{ recipe.category.name }}</p>
        </div>
    </router-link>
</template>

<script>

export default {
    props:['id','recipe'],
    setup(props) {
    // console.log(props.recipe.photo);
        
    },
    
}
</script>