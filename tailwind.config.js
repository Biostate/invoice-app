/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors: {
            'custom-purple': '#7C5DFA',
            'custom-purple-light': '#A78BFA',
            'custom-green': '#33D69F',
            'custom-green-light': '#F3FDFA',
            'custom-orange': '#FF8F00',
            'custom-orange-light': '#FFF9F0',
            'custom-gray': '#373B53',
            'custom-gray-light': '#F4F4F5',
            'custom-black': '#0C0E16',
            'custom-five': '#DFE3FA',
            'custom-six': '#888EB0',
            'custom-seven': '#7E88C3',
            'custom-eight': '#EC5757',
        }
    },
      fontSize: {
          sm: '13px',
          base: '15px',
      }
  },
  plugins: [],
}
