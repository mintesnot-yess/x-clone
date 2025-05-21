<script>
</script>
<template>

    <aside>
        <ul>
            <li class="logo_cont">
                <h1>
                    <a href="/"> <img class="logo" src="img/x-twitter.svg" alt="">
                    </a>
                </h1>
            </li>

            <li data-title="Home">
                <router-link active-class="active" to="/">
                    <img src="img/house.svg" alt="">
                    <span>Home</span>
                </router-link>

            </li>

            <li data-title="Explore">
                <router-link active-class="active" to="/explore">

                    <img src="img/magnifying-glass.svg" alt="">
                    <span>Explore</span>
                </router-link>

            </li>

            <li data-title="Notifications">
                <router-link active-class="active" to="/notification">

                    <img src="img/bell.svg" alt="">
                    <span>Notifications</span>
                </router-link>
            </li>

            <li data-title="Messages">
                <router-link active-class="active" to="/Message">

                    <img src="img/message.svg" alt="">
                    <span>Message</span>
                </router-link>
            </li>


            <li data-title="Communities">
                <router-link active-class="active" to="/community">

                    <img src="img/users.svg" alt="">
                    <span>Communities</span>
                </router-link>
            </li>
            <li data-title="profil">
                <router-link active-class="active" to="/profile">

                    <img src="img/user.svg" alt="">
                    <span>Profile</span>
                </router-link>
            </li>
            <router-link @click="focusPostTextarea()" to="/">
                <button class="postBtn">POST</button>
            </router-link>
        </ul>
    </aside>
    <main>
        <router-view />
    </main>


</template>

<script>
export default {
methods: {
    focusPostTextarea() {
        const textarea = document.getElementById('post_text');
        if (textarea) {
            textarea.focus();
        }
    }
}
}
</script>


<style>
.postBtn {
    color: white;
}
</style>