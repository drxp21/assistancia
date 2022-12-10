const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    theme: {

        extend: {
            fontFamily: {
<<<<<<< HEAD
                // sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {

=======
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
                primary: "#875f5f",
                light: "#b88c8c",
                dark: "#593535",
                drop: "#F7F6F3",

            },
        },
    },

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
