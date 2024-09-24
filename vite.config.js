import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/swagger.js'],
            refresh: true,
        }),
    ],
    // Смотри: https://stackoverflow.com/questions/78029463/vite-config-on-docker
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        }
    }
});
