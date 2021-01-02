const colors = require('tailwindcss/colors');

module.exports = {
	purge: [
		'./src/html/*',
		'./www/**/*',
	],
	darkMode: "class",
	theme: {
		extend: {},
		colors: {
			grey: colors.gray,
			main: colors.violet,
			white: colors.white,
			black: colors.black,
		},
	},
	variants: {
		extend: {},
	},
	plugins: [
		require('@tailwindcss/forms'),
	],
}
