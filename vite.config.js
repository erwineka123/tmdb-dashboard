import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({

    plugins: [

        laravel({

            input: [

                'resources/css/app.css',

                'resources/css/dashboard.css',

                'resources/css/movies.css',

                'resources/js/app.js',

                'resources/js/dashboard.js',

                'resources/js/movies.js',

            ],

            refresh: true,

        }),

    ],

});