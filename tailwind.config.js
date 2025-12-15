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
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: '#000',
      white: '#fff',
      primary: '#ED0000',
      secondary: '#2D2D2A',
      dark: '#393C40',
      body: '#FFEDED',
      // extend other default Tailwind colors optionally if you need
    },
    extend: {
      fontFamily: {
        poppins: ['var(--poppins)', 'sans-serif'],
        gothic: ['var(--gothic)', 'sans-serif'],
      },
      backgroundImage:{
        herobanner: "url('/ausgezeichnet-ribbons/assets/images/banner.jpg')",
        shop: "url('/ausgezeichnet-ribbons/assets/images/shop.jpg')",
        map: "url('/ausgezeichnet-ribbons/assets/images/map.jpg')",
      }
    },
  },
  plugins: [],
}