const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/support/**/*.blade.php',
        './vendor/filament/notifications/**/*.blade.php',
        './vendor/filament/forms/**/*.blade.php',
        './vendor/filament/tables/**/*.blade.php'
    ],
    theme: {
        extend: {
            colors: {
                gray: colors.neutral,
                danger: colors.rose,
                success: colors.green,
                warning: colors.amber,
                primary: {
                    DEFAULT: '#FFCD67',
                    50: '#FFCD67',
                    100: '#FFCD67',
                    200: '#FFCD67',
                    300: '#FFCD67',
                    400: '#FFCD67',
                    500: '#FFCD67',
                    600: '#FFCD67',
                    700: '#FFCD67',
                    800: '#FFCD67',
                    900: '#FFCD67'
                },
                hpc: {
                    red: {
                        DEFAULT: '#5A0410',
                        50: '#F40B2B',
                        100: '#E30A28',
                        200: '#C10922',
                        300: '#9E071C',
                        400: '#7C0616',
                        500: '#5A0410',
                        600: '#4B030D',
                        700: '#3D030B',
                        800: '#2E0208',
                        900: '#1F0106'
                    },
                    gold: {
                        DEFAULT: '#FFCD67',
                        50: '#FFEBC3',
                        100: '#FFE8B9',
                        200: '#FFE1A4',
                        300: '#FFDA90',
                        400: '#FFD47B',
                        500: '#FFCD67',
                        600: '#FFBB2F',
                        700: '#F6A500',
                        800: '#BE7F00',
                        900: '#865A00'
                    }
                }
            },
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans]
            }
        },
        container: {
            center: true
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ]
};
