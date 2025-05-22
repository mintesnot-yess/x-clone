<template>

    <div class="user-detail">
        <!-- LOADING STATE -->
        <div v-if="loading">Loading...</div>

        <!-- ERROR STATE -->
        <div v-else-if="error">Error: {{ error.message }}</div>

        <!-- MAIN CONTENT -->
        <section class="left-section" v-else>
            <!-- Header -->
            <header class="profile-header">
                <router-link to="/" aria-label="Back" type="button">
                    <i class="fas fa-arrow-left"></i>
                </router-link>
                <div>
                    <h1>{{ user.name }}</h1>
                    <p>{{ posts.length }} posts</p>
                </div>
            </header>

            <!-- Banner and Profile Picture -->
            <div class="banner-container">
                <img alt="Abstract blurred colorful background with warm tones" class="banner"
                    src="https://storage.googleapis.com/a1aa/image/c3e99e17-a087-475b-8ef1-c19524f59761.jpg" width="900"
                    height="200" />
                <div class="profile-pic-wrapper">
                    <img :alt="user.profile_pic_alt || 'Profile picture'" :src="'img/' + user.profile_image" width="128"
                        height="128" />
                </div>
            </div>

            <!-- Profile Info -->
            <div class="profile-info-edit">
                <div class="profile-info">
                    <h2>{{ user.name }}</h2>
                    <p class="handle">{{ user.email }}</p>
                    <p class="description">{{ user.description }}</p>
                    <div class="details">
                        <div><i class="fas fa-map-marker-alt"></i> Addis Ababa</div>
                        <div>
                            <i class="fas fa-link"></i>
                            <a href="https://github.com/mintesnot-yess" target="_blank"
                                rel="noopener noreferrer">github.com/mintesnot-yess…</a>
                        </div>
                    </div>
                    <p class="joined">Joined {{ new Date(user.created_at).toLocaleDateString() }}</p>
                </div>
                <button class="edit-profile" type="button">Edit profile</button>
                <button @click="logout" class="edit-profile" type="button">Log Out</button>
            </div>

            <!-- Navigation Tabs -->
            <nav class="tabs" role="tablist" aria-label="Profile navigation">
                <button aria-current="page" type="button">Posts</button>
                <button type="button">Replies</button>
            </nav>



            <!-- User Posts -->
            <div v-if="posts.length">
                <article v-for="post in posts" :key="post.id" class="pinned-post"
                    aria-label="Pinned post by Mintesnot yesmashwa">

                    <div class="post-header">
                        <img :alt="'Profile picture of ' + user.name" :src="'img/' + user.profile_image" width="32"
                            height="32" style="border-radius: 9999px; object-fit: cover;" />
                        <strong>{{ user.name }}</strong>
                        <span>@{{ user.name }} · @{{ user.name }} · {{ new Date(post.created_at).toLocaleDateString()
                        }}</span>
                        <button class="promote" type="button">Edit</button>
                        <button @click="deletePost(post.id)" aria-label="Mute notifications" class="icon-btn"
                            type="button"><i class="fas fa-trash"></i></button>
                        <button aria-label="More options" class="icon-btn" type="button"><i
                                class="fas fa-ellipsis-h"></i></button>

                    </div>
                    <p class="post-text">{{ post.content }} </p>
                    <img v-if="post.image" class="post-image" :alt="'Post image'" :src="`/storage/${post.image}`"
                        width="600" height="400" />
                </article>
            </div>

            <div class="post-yet" v-else>No posts yet</div>
        </section>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const user = ref(null)
const posts = ref([])
const loading = ref(true)
const error = ref(null)

const fetchUserAndPosts = async () => {
    try {
        const token = localStorage.getItem('token')

        const userRes = await axios.get('api/user', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
        user.value = userRes.data
        document.title = "Profile | " + user.value.name

        const postsRes = await axios.get('api/user-posts', {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
        posts.value = postsRes.data
    } catch (err) {
        error.value = err
    } finally {
        loading.value = false
    }
}

const deletePost = async (id) => {
    if (!confirm('Are you sure you want to delete this post?')) return

    try {
        await axios.delete(`api/posts/${id}`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        })
        posts.value = posts.value.filter(post => post.id !== id)
    } catch (err) {
        console.error('Failed to delete post:', err)
        alert('Failed to delete post.')
    }
}
const logout = async () => {
    try {
        await axios.post('api/logout', {}, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
            },
        });

        localStorage.removeItem('token');
        localStorage.removeItem('user');

        window.location.href = '/';
    } catch (err) {
        console.error('Logout failed:', err);
        alert('Logout failed.');
    }
};



onMounted(fetchUserAndPosts)

</script>


<style scoped>
.profile-header .fas.fa-arrow-left {
    font-size: 1.3rem;
    color: #fff;
    transition: color 0.2s;
}

.post-yet {
    color: #fff;
    text-align: center;
    padding: 20px 0;
}
</style>