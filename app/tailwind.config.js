/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class', // or 'media' or 'class'
  content: ['./public/assets/js/*.js', './public/assets/css/*.css','*.html','./views/*.php','./views/permanents/*.php'],
  theme: {
    extend: {},
  },
  plugins: [],
}

