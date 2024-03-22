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
          colors: {
            "green": "#19C580",
            "dark-green": "#007848",
            "middle-dark-green": "#00A864",
            "middle-light-green": "#43D198",
            "light-green": "#7BE2B8",
            "daark-green": "#0B643E",
          },
          fontFamily: {
              "man-rope": "ManRope",
              "space-grotesk": ["SpaceGrotesk", "sans-serif"],
          },
          maxWidth: {
            "8xl": "1270px"
          },
        },
      },

    plugins: [forms],
};
