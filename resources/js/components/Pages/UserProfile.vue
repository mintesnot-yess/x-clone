<template>
    <!-- <div v-if="!loading && user">
        <h2>{{ user.name }}</h2>
        <p>{{ user.email }}</p>
        <p>{{ user.posts_count }} posts</p>

        <div v-for="post in user.posts" :key="post.id" class="post">
            <p>{{ post.content }}</p>
            <img v-if="post.image" :src="`storage/${post.image}`" width="300" />
        </div>
    </div>

    <div v-else-if="loading">Loading...</div>
    <div v-else-if="error">Error: {{ error.message }}</div>

 -->




    <!--  -->


    <div class="user-detail">

        <!-- MAIN CONTENT -->
        <section class="left-section" v-if="!loading && user">
            <!-- Header -->
            <header class="profile-header">
                <router-link to="/" aria-label="Back" type="button">
                    <i class="fas fa-arrow-left"></i>
                </router-link>
                <div>
                    <h1>{{ user.name }}</h1>
                    <p>{{ user.posts_count }} posts</p>
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

            </div>

            <!-- Navigation Tabs -->
            <nav class="tabs" role="tablist" aria-label="Profile navigation">
                <button aria-current="page" type="button">Posts</button>
                <button type="button">Replies</button>
            </nav>



            <!-- User Posts -->
            <article v-for="post in user.posts" :key="post.id" class="pinned-post"
                aria-label="Pinned post by Mintesnot yesmashwa">

                <div class="post-header">
                    <img :alt="'Profile picture of ' + user.name" :src="'img/' + user.profile_image" width="32"
                        height="32" style="border-radius: 9999px; object-fit: cover;" />
                    <strong>{{ user.name }}</strong>
                    <span>@{{ user.name }} · @{{ user.name }} · {{ new Date(post.created_at).toLocaleDateString()
                    }}</span>
                    <button class="promote" type="button"></button>
                    <button @click="deletePost(post.id)" aria-label="Mute notifications" class="icon-btn"
                        type="button"><i class="fas fa-bell-slash"></i></button>
                    <button aria-label="More options" class="icon-btn" type="button"><i
                            class="fas fa-ellipsis-h"></i></button>

                </div>
                <p class="post-text">{{ post.content }} </p>
                <img v-if="post.image" class="post-image" :alt="'Post image'" :src="`/storage/${post.image}`"
                    width="600" height="400" />
            </article>









            <!-- <div class="post-yet" v-else>No posts yet</div> -->
        </section>
        <!-- LOADING STATE -->
        <div v-else-if="loading">Loading...</div>

        <!-- ERROR STATE -->
        <div v-else-if="error">Error: {{ error.message }}</div>

    </div>










</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const user = ref(null)
const loading = ref(true)
const error = ref(null)

const fetchUserByEmail = async () => {
    try {
        const email = route.params.email

        const response = await axios.get(`api/users/${encodeURIComponent(email)}`)
        user.value = response.data;
        document.title = "Profile | " + user.value.name

    } catch (err) {
        error.value = err
    } finally {
        loading.value = false
    }
}

onMounted(fetchUserByEmail)
</script>
