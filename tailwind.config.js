const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
  './resources/views/**/*.blade.php',
  './resources/js/**/*.js',
  './storage/framework/views/*.php',
  './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
],


    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
