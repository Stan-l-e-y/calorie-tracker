const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/views/dashboard.blade.php",
        "./Modules/**/*.blade.php",
        "./resources/views/layouts/app.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                40: "10rem",
                70: "17rem",
                90: "22.5rem",
            },
            width: {
                21: "500px",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
