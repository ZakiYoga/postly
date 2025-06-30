import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ["resources/css/app.css", 'resources/css/trix-style.css', "resources/js/app.js"],
            refresh: true,
        }),
    ],
    base: process.env.APP_ENV === 'production' ? 'https://postly-production.up.railway.app/' : '/',
});
