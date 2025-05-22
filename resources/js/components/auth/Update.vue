<template>
    <form @submit.prevent="updateProfile" enctype="multipart/form-data">
        <div>
            <label>Name:</label>
            <input type="text" v-model="form.name" required />
        </div>

        <div>
            <label>Email:</label>
            <input type="email" v-model="form.email" required />
        </div>

        <div>
            <label>New Password:</label>
            <input type="password" v-model="form.password" />
        </div>

        <div>
            <label>Confirm Password:</label>
            <input type="password" v-model="form.password_confirmation" />
        </div>

        <div>
            <label>Profile Image:</label>
            <input type="file" @change="handleFileUpload" />
        </div>

        <button type="submit">Update Profile</button>
    </form>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const form = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    profile_image: null,
})

const handleFileUpload = (e) => {
    form.value.profile_image = e.target.files[0]
}

onMounted(async () => {
    const token = localStorage.getItem('token')
    const res = await axios.get('http://127.0.0.1:8000/api/user', {
        headers: { Authorization: `Bearer ${token}` }
    })
    form.value.name = res.data.name
    form.value.email = res.data.email
})

const updateProfile = async () => {
    const token = localStorage.getItem('token')
    const formData = new FormData()
    for (const key in form.value) {
        if (form.value[key]) formData.append(key, form.value[key])
    }

    try {
        const res = await axios.put('api/user/update', formData, {
            headers: {
                Authorization: `Bearer ${token}`,
                'Content-Type': 'multipart/form-data'
            }
        })
        alert('Profile updated successfully!')
    } catch (err) {
        alert('Update failed.')
        console.error(err)
    }
}
</script>
