import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/filament.css',
                'resources/css/litepicker.css',
                'resources/js/app.js',
                'resources/js/chart.js',
                'resources/js/litepicker.js',
            ],
            refresh: true
        })
    ]
});
