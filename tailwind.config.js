import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue'
    ],

    theme: {
        extend: {
            backgroundImage: {
                'site-body': 'url("/storage/app/images/background_texture.png")'
                // 'site-body': 'url("https://www.dndbeyond.com/content/1-0-3036-0/skins/waterdeep/images/background_texture.png")'
            },
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                sans: ['Roboto', 'Helvetica', 'sans-serif', ...defaultTheme.fontFamily.sans]
            }
        }
    },

    plugins: [forms],

    darkMode: ['selector', '[data-theme="dark"]']
};
