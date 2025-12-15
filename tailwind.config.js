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
    screens: {
      xs: '480px',
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1300px',
      '2xl': '1575px',
    },
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
      backgroundImage:{
        herobanner:"url('/ribbons/assets/images/banner.jpg')",
        shop:"url('/ribbons/assets/images/shop.jpg')",
        map:"url('/ribbons/assets/images/map.jpg')",
      }
    },
  },
  plugins: [],
}
