// tailwind.config.js
module.exports = {
  content: ["./FRONTEND/**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        primary: "#1e90ff", // Example custom color
      },
      transitionProperty: {
        'height': 'height',
      }
    },
  },
  variants: {
    extend: {
      visibility: ['group-hover'],
      opacity: ['group-hover'],
    },
  },
  plugins: [],
};