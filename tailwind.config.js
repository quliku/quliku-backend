/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        colors: {
            orange: {
                primary: "#F98214",
                secondary: "#FBA85B",
            },
            black: {
                primary: "#424242",
                secondary: "#8E8E8E",
            },
            white: {
                primary: "#FFFFFF",
                secondary: "#F3F3F3",
            },
            green: {
                primary: "#7BBB71",
                secondary: "#EAFFE7",
            },
            red: {
                primary: "#A91325",
                secondary: "#DB324D",
            },
        },
        extend: {},
    },
    plugins: [require("@tailwindcss/forms")],
};
