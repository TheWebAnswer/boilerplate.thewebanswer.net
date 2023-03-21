/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "media",
  content: [
    "./assets/**/*.js",
    "./templates/**/*",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        'dark': '#0f172a',
        'light': '#f1f5f9',
        'gray': '#64748b',
        'primary': '#a855f7',
        'primary-light': '#d8b4fe',
        'primary-dark': '#7e22ce',
        'hoche-primary': '#D9AD70',
        'impulsion-primary': '#790427',
        'dj2v-primary': '#FACC15',
        'music-primary': '#1DB954',
      },
      fontFamily: {
        'montserrat': ['Montserrat'],
        'inter': ['Inter'],
      },
    },
  },
  plugins: [
    require('flowbite/plugin'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}
