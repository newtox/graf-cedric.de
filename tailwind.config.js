/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        pixel: ['"Press Start 2P"', 'cursive'],
        mono: ['"VT323"', 'monospace'],
      },
      colors: {
        retro: {
          bg: 'rgb(var(--c-bg) / <alpha-value>)',
          panel: 'rgb(var(--c-panel) / <alpha-value>)',
          panelLight: 'rgb(var(--c-panel-light) / <alpha-value>)',
          border: 'rgb(var(--c-border) / <alpha-value>)',
          accent: 'rgb(var(--c-accent) / <alpha-value>)',
          accent2: 'rgb(var(--c-accent2) / <alpha-value>)',
          text: 'rgb(var(--c-text) / <alpha-value>)',
          muted: 'rgb(var(--c-muted) / <alpha-value>)',
        },
      },
    },
  },
  plugins: [],
}
