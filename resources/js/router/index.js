import { createRouter, createWebHashHistory } from "vue-router";
import Home from "../components/Pages/Home.vue";
import Explore from "../components/Pages/Explore.vue";
import Notification from "../components/Pages/Notification.vue";

import Profile from "../components/auth/Profile.vue";
import Login from "../components/auth/Login.vue";
import Register from "../components/auth/Register.vue";
import Post from "../components/auth/Post.vue";

const isAuthenticated = !!localStorage.getItem('user');

const routes = isAuthenticated
  ? [
    { path: "/", component: Home },
    { path: "/profile", component: Profile },
    { path: "/explore", component: Explore },
    { path: "/notification", component: Notification },
    { path: "/post", component: Post },
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

export default router;
