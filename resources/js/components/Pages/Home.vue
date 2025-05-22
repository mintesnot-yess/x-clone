<template>
    <div class="recommendation">
        <ul>
            <li><span class="active">For you</span></li>
            <li><span>Following</span></li>
        </ul>
    </div>

    <div class="post_cont">

        <div class="user_post">

            <img src="img/user.svg" alt="">
            <form @submit.prevent="submitPost" enctype="multipart/form-data">

                <textarea v-model="form.content" placeholder="What is happening?" id="post_text"
                    name="post_text"></textarea>

                <label for="post_image">
                    <img src="img/image.svg" alt=""></label>
                <input type="file" @change="handleFile" name="post_image" id="post_image">

                <button type="submit">Post</button>
            </form>
        </div>
        <div class="preview">
            <img class="preview_img" src="" alt="">

        </div>
    </div>






    <div v-if="posts.length">
        <article v-for="post in posts" :key="post.id" class="pinned-post"
            aria-label="Pinned post by Mintesnot yesmashwa">

            <div class="post-header">
                <img :alt="'Profile picture of ' + post.user.name" :src="'img/' + post.user.profile_image" width="32"
                    height="32" style="border-radius: 9999px; object-fit: cover;" />
                <router-link :to="`/profile/${post.user.email}`">{{ post.user.name }}</router-link>
                <span>@{{ post.user.name }} · @{{ post.user.email }} · {{ new
                    Date(post.created_at).toLocaleDateString()
                    }}</span>
                <button class="promote" type="button"> </button>
                <button aria-label="Mute notifications" class="icon-btn" type="button"><i
                        class="fas fa-bell-slash"></i></button>
                <button aria-label="More options" class="icon-btn" type="button"><i
                        class="fas fa-ellipsis-h"></i></button>

            </div>
            <p class="post-text">{{ post.content }} </p>
            <img v-if="post.image" class="post-image" :alt="'Post image'" :src="`/storage/${post.image}`" width="600"
                height="400" />
        </article>
    </div>





</template>

<script>
import axios from 'axios';
import router from '../../router';

export default {


    data() {
        return {
            form: {
                content: '',
                image: null,
            },
            posts: [],

        };
    },
    mounted() {
        this.fetchPosts();
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
                // redirect home
                this.form.content = '';
                this.form.image = null;
                this.fetchPosts();


            } catch (error) {
                if (error.response) {
                    console.error('Server responded with error:', error.response.data);
                } else if (error.request) {
                    console.error('No response received:', error.request);
                } else {
                    console.error('Error setting up request:', error.message);
                }
            }
        }, async fetchPosts() {
            try {
                const response = await axios.get('api/posts');
                this.posts = response.data;
            } catch (error) {
                console.error('Failed to fetch posts:', error);
            }
        },
        showMore(post) {
            console.log(post.content)
        },
    },


};
</script>
