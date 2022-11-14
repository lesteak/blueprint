module.exports = {
  theme: {
    fontFamily: {
      sans: ['Miriam Libre', 'sans-serif'],
    },
    flex: {
      half: '1 1 50%',
    },
  },
  variants: {},
  plugins: [],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/yadda/enso-core/resources/views/dev/responsive-helper.blade.php"
  ],
};
