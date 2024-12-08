<template>

    <tr class=" hover:bg-gray-100">
        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ user.id }}</td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ user.name }}</td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ user.email }}</td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ user.created_at }}</td>
    </tr>
    
</template>

<script setup>
defineProps({
    user:{
        type:Object
    }
});
</script>
