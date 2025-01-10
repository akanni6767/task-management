module.exports = {
    syntax: 'postcss-scss',
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
        cssnano: process.env.NODE_ENV === 'production' ? {} : false,
    },
  };
  