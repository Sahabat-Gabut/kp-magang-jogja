const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [],
    darkMode: false,
    theme: {
        minHeight: {
            '96': '24rem',
        },
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            transitionTimingFunction: {
                'in-expo': 'all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1)',
            },
            screens: {
                'print': {'raw': 'print'},
            },
            colors: {
                gray: colors.gray,
                red: colors.red,
                orange: colors.orange,
                amber: colors.amber,
                yellow: colors.yellow,
                green: colors.green,
                emerald: colors.emerald,
                teal: colors.teal,
                sky: colors.sky,
                blue: colors.blue,
                indigo: colors.indigo,
            },
            order: {
                first: '-9999',
                last: '9999',
                none: '0',
                normal: '0',
                '1': '1',
                '2': '2',
                '3': '3',
                '4': '4',
                '5': '5',
                '6': '6',
                '7': '7',
                '8': '8',
                '9': '9',
                '10': '10',
                '11': '11',
                '12': '12',
            },
            fontSize: {
                'xs': '.75rem',
            },
            spacing: {
                '17': '4.75rem',
                '32': '8rem'
            },
        },
    },
    variants: {
        extend: {
            borderWidth: ['last']
        },
    },
    plugins: [
        require('tailwind-scrollbar'),
    ],
}
