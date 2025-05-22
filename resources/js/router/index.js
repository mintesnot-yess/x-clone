import { createRouter, createWebHashHistory } from "vue-router";
import Home from "../components/Pages/Home.vue";
import Explore from "../components/Pages/Explore.vue";
import Notification from "../components/Pages/Notification.vue";
import UserProfile from "../components/Pages/UserProfile.vue";

import Profile from "../components/auth/Profile.vue";
import Login from "../components/auth/Login.vue";
import Register from "../components/auth/Register.vue";
import Post from "../components/auth/Post.vue";
import Update from "../components/auth/Update.vue";

const isAuthenticated = !!localStorage.getItem('user');

const routes = isAuthenticated
  ? [
    {
      path: "/",
      component: Home,
      meta: { title: 'Home' }
    },
    {
      path: "/profile",
      component: Profile,
      meta: { title: 'Profile' }
    },
    {
      path: "/explore", component: Explore,
      meta: { title: 'Explore' }
    },
    { path: "/update", component: Update },
    { path: "/notification", component: Notification },
    { path: "/post", component: Post },
    {
      path: "/profile/:email", component: UserProfile,
      meta: { title: 'Profile' }
    },
    { path: "/:catchAll(.*)", redirect: "/" }

  ]
  : [
    { path: "/login", component: Login },
    { path: "/register", component: Register },
    { path: "/:catchAll(.*)", redirect: "/login" }
  ];


const router = createRouter({
  history: createWebHashHistory(),
  routes
});
// router/index.js
router.afterEach((to) => {
  if (to.meta.title) {
    document.title = to.meta.title
  }
})


export default router;
