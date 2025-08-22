/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.html",
    "./assets/**/*.{js,jsx,ts,tsx,vue}"
  ],
  theme: {
    extend: {
      colors: {
        'dark': {
          500: '#1f2937',
          600: '#1f2937',
          700: '#1f2937'
        }
      }
    }
  },
  plugins: [],
}
