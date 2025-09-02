import './bootstrap';
import { createApp } from 'vue';

import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';

import Swal from 'sweetalert2/dist/sweetalert2.js';

//import App from './App.vue'; 

const app = createApp(App);
app.use(Antd);
app.config.globalProperties.$swal = Swal;

app.mount('#app');
