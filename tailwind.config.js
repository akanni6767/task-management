/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/**/*.{php,js}"],
  theme: {
    fontFamily: {
      inter: 'Inter, sans-serif',
      roboto: 'roboto, sans-serif',
      fa: 'FontAwesome'
    },
    extend: {
      keyframes: {
        parallax: {
          '0%': {
            objectPosition: 'center'
          },
          '100%': {
            objectPosition: '0 0'
          }
        },
        shimmer: {
          '0%': { transform: 'translateX(-100%)' },
          '100%': { transform: 'translateX(100%)' },
        },
      },
      animation: {
        parallax: 'parallax linear both',
        'spin-slow': 'spin 3s linear infinite',
        'spin-fast': 'spin 0.5s linear infinite',
        shimmer: 'shimmer 1.5s infinite',
      },
      
      zIndex: {
        51: 51,
        52: 52,
        53: 53
      },
    },
  },
  plugins: [],
}

