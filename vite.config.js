import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'Modules/Simadu/resources/css/spa.css',
                'Modules/Simadu/resources/js/spa.js',
                'Modules/Nuswim/resources/css/spa.css',
                'Modules/Nuswim/resources/js/spa.js',
                'Modules/Masjid/resources/css/spa.css',
                'Modules/Masjid/resources/js/spa.js',
                'Modules/Wakepen/resources/css/spa.css',
                'Modules/Wakepen/resources/js/spa.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
