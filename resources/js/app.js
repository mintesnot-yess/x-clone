import { createApp } from "vue";
import appComponent from "./App.vue";
import router from "./router";

const app = createApp({
    components: {
        appComponent
    }
});
app.use(router);
app.mount("#app");
