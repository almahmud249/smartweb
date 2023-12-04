require('./bootstrap');
import { createApp, h } from 'vue'
import {createInertiaApp, Link} from '@inertiajs/vue3'
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import 'bootstrap/dist/js/bootstrap.js';
import '@fortawesome/fontawesome-free/css/all.css';


createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("InertiaLink", Link)
            .mount(el)
    },
})
