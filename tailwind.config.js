/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.php",
    "./action/**/*.php",
    "./view/**/*.php",
    "./ad-min/**/*.php",
    "./includes/**/*.php",
    "./src/**/*.css",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#ED0000',
        secondary: '#2D2D2A',
        dark: '#393C40',
        body: '#FFEDED',
      },
      fontFamily: {
        poppins: ['var(--poppins)'],
        gothic: ['var(--gothic)'],
      },
      
    },
  },
  plugins: [],
}
