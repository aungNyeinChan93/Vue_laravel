<template>
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">ID</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Date</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                <TableRole  v-for="user in users" :key="user.id" :user="user" />
            </tbody>
        </table>
    </div>
</template>

<script setup>
import TableRole from './TableRole.vue';

defineProps({
    users:{
        type:Array
    }
});

</script>