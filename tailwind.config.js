module.exports = {
  important: true,
  theme: {
    fontFamily: {
      sans: ['Miriam Libre', 'sans-serif'],
    },
    flex: {
      half: '1 1 50%',
    },
    extend: {
      colors: {
        "brand-blue": "#1b3377",
        "brand-grey": {
          "100": "#bdbfca",
          "200": "#25272e",
          "500": "#141519"
        }
      },
      fontFamily: {
        teko: ["teko", "sans-serif"],
        cabin: ["Cabin", "sans-serif"]
      },
      fontSize: {
        '10xl': ['158px', '128px']
      }
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
