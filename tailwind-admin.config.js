const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/curator/resources/views/**/*.blade.php'
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.amber,
                success: colors.green,
                warning: colors.amber,
                gray: colors.neutral
            },
            fontFamily: {
                sans: [ 'Poppins', ...defaultTheme.fontFamily.sans ]
            }
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ]
};
