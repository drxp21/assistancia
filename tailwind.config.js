const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    theme: {

        extend: {
            fontFamily: {
                // sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {

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
