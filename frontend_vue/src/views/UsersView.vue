<template>
    <div class="container mx-auto px-10 my-5">
        <TableComponent :users="usersStore.users"/>
    </div>
</template>

<script setup>
import TableComponent from '@/components/TableComponent.vue';
import { useUsersStore } from '@/stores/useUsersStore';
import { onMounted } from 'vue';

const usersStore  = useUsersStore();

onMounted(()=>{
    usersStore.getUserData();
});
</script>

