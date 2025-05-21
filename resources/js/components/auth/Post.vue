<template>
    <form @submit.prevent="submitPost" enctype="multipart/form-data">
        <input type="file" @change="handleFile" />
        <textarea v-model="form.content" placeholder="Write content..."></textarea>
        <button type="submit">Submit</button>
    </form>
</template>

<script>

import axios from 'axios';

export default {
    data() {
        return {
            form: {
                content: '',
                image: null,
            },
        };
    },
    methods: {
        handleFile(e) {
            this.form.image = e.target.files[0];
        },
        async submitPost() {
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            const userId = user.id || '';

            const formData = new FormData();
            formData.append('user_id', userId);
            formData.append('content', this.form.content);
            if (this.form.image) {
                formData.append('image', this.form.image);
            }

            try {
                const res = await axios.post('api/posts', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                // console.log('Post created:', res.data); // ✅ safely accessing res.data
            } catch (error) {
                // ✅ safer error handling
                if (error.response) {
                    // Laravel validation or server error
                    console.error('Server responded with error:', error.response.data);
                } else if (error.request) {
                    // No response from server
                    console.error('No response received:', error.request);
                } else {
                    // Axios setup error
                    console.error('Error setting up request:', error.message);
                }
            }
        }
    },
};
</script>
