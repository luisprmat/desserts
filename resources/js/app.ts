import { createInertiaApp } from '@inertiajs/vue3';
import { i18nVue } from 'laravel-vue-i18n';
import '../css/app.css';

createInertiaApp({
    withApp: (app) =>
        app.use(i18nVue, {
            resolve: async (lang: string) => {
                const langs = import.meta.glob('../../lang/*.json');
                return await langs[`../../lang/${lang}.json`]();
            },
        }),
    title: (title) => (title ? `Frontend Mentor | ${title}` : 'Product list with cart'),
});
