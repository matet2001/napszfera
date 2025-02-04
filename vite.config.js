import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';

// Function to get all files from a directory
const getFiles = (dir, fileType) => {
    return fs.readdirSync(dir)
        .filter(file => file.endsWith(fileType))
        .map(file => path.join(dir, file));
};

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/header.js',
                'resources/js/bootstrap.js',
                'resources/js/mobile-sidemenu.js',
                'resources/js/password-eye.js',
                'resources/js/product-upload.js',

                'resources/css/app.css',
                'resources/css/header.css',
                'resources/css/legal-format.css',
                'resources/css/progress-bar.css',
                'resources/css/static-format.css',

                'resources/images/facebook.png',
                'resources/images/instagram.png',
                'resources/images/logo.svg',
                'resources/images/logo2.svg',
                'resources/images/placeholder.jpg',
                'resources/images/tiktok.png',
                'resources/images/youtube.png',

            ],
            refresh: true,
        }),
    ],
});
