module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    extend: {
      outline: {
        'light': '#81D2F6',
      },
      backgroundColor: theme => ({
        'light': '#81D2F6',
        'main': '#60D0F8',
        'black': 'black',
        'form': '#ffffff',
        'white': 'white',
        'form2': '#f5f5f5',
        'grey': '#3f6277'
      }),
      colors: theme => ({
        'light': '#81D2F6',
        'main': '#60D0F8',
        'grey': '#8c8c8c',
        'white': 'white'
  
      }),
      borderColor: theme => ({
        ...theme('colors'),
        DEFAULT: theme('colors.gray.300', 'currentColor'),
        'light': '#81D2F6',
        'primary': '#3490dc',
        'secondary': '#ffed4a',
        'danger': '#e3342f',
        'grey': '#3f6277',
        'form': '#dbdbdb'
      }),
      fontSize: {
        'xs': '.75rem',
        'sm': '.875rem',
        'tiny': '.875rem',
        'base': '1rem',
        'lg': '1.125rem',
        'xl': '1.25rem',
        '2xl': '1.5rem',
        '3xl': '1.875rem',
        '4xl': '2.25rem',
        '5xl': '3rem',
        '6xl': '4rem',
        '7xl': '5rem',
        '8xl': '6.6rem',
        '9xl': '8rem',
        '10xl':'10rem'
      },
      fontFamily: {
        'nunito': ['nunito', 'sans-serif'],
      }
      
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
