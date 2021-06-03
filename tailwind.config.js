const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            textColor: theme => theme('colors'),
            backgroundColor: {
                'primary': 'rgb(255,128,0)',
                'secondary': 'rgb(255,128,0)'
            },
            textColor: {
                'primary': 'rgb(255,128,0)',
                'secondary': 'rgb(255,128,0)'
            },
            backgroundImage: theme => ({
                'main-background': "url('/assets/images/main-background.jpg')",
            }),
            screens: theme => theme('screens'),
            screens: {
                'xs': { 'min': '475px', 'max': '639px' }
            },
            borderColor: theme => ({
                ...theme('colors'),
                DEFAULT: theme('colors.gray.300', 'currentColor'),
                'primary': 'rgb(255,128,0)',
                'secondary': 'rgb(255,128,0)',
                // 'old-primary': '#F0975C'
            }),
            keyframes: {
                'swing': {
                    '0%,100%': { transform: 'rotate(15deg)' },
                    '50%': { transform: 'rotate(-15deg)' },
                }
            },
            animation: {
                'swing': 'swing 1s infinite'
            }
        },
        spinner: (theme) => ({
            default: {
                color: '#000000',
                size: '1em',
                border: '2px',
                speed: '500ms',
            },
        }),
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
        spinner: ['responsive'],
    },

    plugins: [
        require('@tailwindcss/forms'), require('@tailwindcss/typography'),
        require('tailwindcss-spinner')({ className: 'spinner', themeKey: 'spinner' }),
    ],
};