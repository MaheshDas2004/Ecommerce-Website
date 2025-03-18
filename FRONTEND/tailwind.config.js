// tailwind.config.js
export default {
    content: ["./FRONTEND/**/*.{html,js,php}"], // Specify the files Tailwind should scan for classes
    theme: {
      extend: {
        colors: {
          primary: "#1e90ff", // Example custom color
        },
      },
    },
    plugins: [], // Add plugins if needed
  };