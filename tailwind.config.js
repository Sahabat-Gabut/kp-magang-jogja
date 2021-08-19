const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: false,
    darkMode: false,
    theme: {
        minHeight: {
            '96': '24rem',
        },
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                'print': {'raw': 'print'},
            },
            colors: {
                blueGray: colors.blueGray,
                coolGray: colors.coolGray,
                gray: colors.gray,
                trueGray: colors.trueGray,
                warmGray: colors.warmGray,
                red: colors.red,
                orange: colors.orange,
                amber: colors.amber,
                yellow: colors.yellow,
                lime: colors.lime,
                green: colors.green,
                emerald: colors.emerald,
                teal: colors.teal,
                cyan: colors.cyan,
                sky: colors.sky,
                blue: colors.blue,
                indigo: colors.indigo,
                violet: colors.violet,
                purple: colors.purple,
                fuchsia: colors.fuchsia,
                pink: colors.pink,
                rose: colors.rose,
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
            spacing: {
                '17': '4.75rem'
            },
        },
    },
    variants: {
        extend: {
            borderWidth: ['last']
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('tailwind-scrollbar')
    ],
}
