/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class', // włączony tryb ciemny
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    light: '#3b82f6',  // jasnoniebieski
                    DEFAULT: '#2563eb', // główny
                    dark: '#1e40af',    // ciemny
                },
                accent: '#f59e0b',    // pomarańcz
            },
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui'],
            },
            boxShadow: {
                'card': '0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05)',
            },
            transitionProperty: {
                'height': 'height',
                'spacing': 'margin, padding',
            }
        },
    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
};
