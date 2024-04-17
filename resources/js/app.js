import './bootstrap';
import '../css/app.css';
import '../src/js/plugins/jquery/dist/jquery.min.js';
import '../src/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js';
import '../src/vendor/js-cookie/js.cookie.js';
import '../src/js/argon.js';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy.js';

import { ValidationMixin } from '@/plugins/mixins';
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'
import VueApexCharts from "vue3-apexcharts";
import VueNumberFormat from '@coders-tm/vue-number-format'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {library} from "@fortawesome/fontawesome-svg-core";
import {fas} from "@fortawesome/free-solid-svg-icons";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

library.add(fas)

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(LaravelPermissionToVueJS)
            .use(VueApexCharts)
            .use(VueNumberFormat, { precision: 2, decimal: '.' })
            .mixin(ValidationMixin)
            .component('font-awesome-icon', FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
