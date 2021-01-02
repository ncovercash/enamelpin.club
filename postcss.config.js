module.exports = {
	plugins: [
		require("postcss-nested"),
		require("autoprefixer"),
		require("cssnano"),
		require("postcss-import"),
		require("postcss-preset-env"),
		require("tailwindcss"),
	]
};
