import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'], // Wskazuje na pliki CSS i JS Laravel
            refresh: true,
        }),
    ],
    server: {
        host: 'localhost',
        port: 5173,
    },
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
});