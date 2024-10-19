/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    screens: {
      xs: '380px', // Экраны меньше 480px
      sm: '380px', // Экраны от 640px до 767px
      md: '380px', // Экраны от 768px до 1023px
      lg: '380px', // Экраны от 1024px до 1279px
      xl: '380px', // Экраны от 1280px и больше
    },

    extend: {

      colors: {
        black_1: '#16181D',
        dark: '#26282E',
        gray: '#7E8EA1',
        gray_1: '#898D92',
        blue: '#5982FF',
        white_1: '#D9D9D9',
        gray_2: '#31343E',



      },
    },
  },

}

