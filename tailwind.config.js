import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                "primary-orange": "#FF6B35",
                "primary-green": "#4CAF50",
                "orange-dark": "#E55A2B",
                "green-dark": "#388E3C",
                "orange-light": "#FFE5DC",
                "green-light": "#E8F5E9",
                "background-light": "#FAFAFA",
                "background-dark": "#0F1419",
                "surface-light": "#FFFFFF",
                "surface-dark": "#1A2027",
            },
            fontFamily: {
                "display": ["Plus Jakarta Sans", "sans-serif"],
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'float': 'float 3s ease-in-out infinite',
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'slide-up': 'slideUp 0.5s ease-out', // Animasi tambahan untuk text header
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-20px)' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                }
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/container-queries'),
    ],
};