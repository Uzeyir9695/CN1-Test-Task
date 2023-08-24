import './bootstrap';
import { createApp } from 'vue';
// Packages
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
// Components
import House from "./House.vue"

const app = createApp(House)
app.use(ElementPlus)
app.mount('#app');
