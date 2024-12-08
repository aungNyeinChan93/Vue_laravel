
import axios from 'axios';
import { defineStore } from 'pinia'
import { ref } from 'vue'


export const useUsersStore = defineStore('usersStore', () => {
    const users = ref([]);

    const getUserData = async()=>{
        const res = await axios.get("http://127.0.0.1:8000/api/users");
        users.value = res.data.users
    }
    return {users,getUserData}
})
