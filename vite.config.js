import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
<<<<<<< HEAD
                "resources/css/app.css",
                "resources/sass/app.scss",
                "resources/js/app.js",
=======
                'resources/css/app.css',
                'resources/sass/app.scss',
                'resources/js/app.js',
>>>>>>> 00ebd00b80177db8a8a0e18f671af4a9400545ee
            ],
            refresh: true,
        }),
    ],
});
