module.exports = {
    content: [
        "node_modules/@frostui/tailwindcss/**/*.js",
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    // Aktifkan dark mode class + data attribute
    darkMode: ['class', '[data-mode="dark"]'],

    // Tambahkan safelist HEX custom agar tidak dipurge
    safelist: [
        { pattern: /bg-\[\#([a-fA-F0-9]{6})\]/ },
        { pattern: /text-\[\#([a-fA-F0-9]{6})\]/ },
        { pattern: /border-\[\#([a-fA-F0-9]{6})\]/ },
    ],

    theme: {
        container: {
            center: true,
        },

        fontFamily: {
            'base': ['Inter', 'sans-serif'],
        },

        extend: {
            colors: {
                // Palet default Konrix
                'primary': '#3073F1',
                'secondary': '#68625D',
                'success': '#1CB454',
                'warning': '#E2A907',
                'info': '#0895D8',
                'danger': '#E63535',
                'light': '#eef2f7',
                'dark': '#313a46',

                // ✅ Palet Branding STH Network
                'sth-orange': '#F39C12',
                'sth-blue': '#5DADE2',
                'sth-light': '#FFF8E7',
                'sth-dark': '#111827',
                'sth-gray': '#BDC3C7',
            },
        },
    },

    plugins: [
        require('@frostui/tailwindcss/plugin'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
    ],
}

