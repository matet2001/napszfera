import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                mono: ['Roboto Mono', ...defaultTheme.fontFamily.mono],
            },
            colors: {
                'text': '#E5B8F4',
                'background': '#2D033B',
                'primary': '#810CA8',
                'secondary': '#C147E9',
                'accent': '#E5B8F4',
            },
            textTransform: {
                'uppercase': 'uppercase',
            },
        },
    },

    plugins: [forms],
};
