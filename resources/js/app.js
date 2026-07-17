import '../css/app.css';
import '../css/site.css';
import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, h } from 'vue';

const pages = import.meta.glob('./Pages/**/*.vue');

createInertiaApp({
    resolve: (name) => pages[`./Pages/${name}.vue`](),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
    progress: {
        color: '#111827',
    },
});
