const path = require("path");

module.exports = {
	mode: "development",
	entry: "./src/js/entry.ts",
	output: {
		filename: "webpack.js",
		path: __dirname + "/dist/js/",
	},
	resolve: {
		extensions: [".ts", ".tsx", ".js"],
	},
	module: {
		rules: [
			{
				test: /\.tsx?/,
				loader: "ts-loader",
				options: {
					configFile: "src/js/tsconfig.json",
				}
			},
			{
				test: /\.scss$/,
				use: [
					'style-loader',
					"css-loader",
					'sass-loader',
				]
			}
		],
	},
	devtool: "eval-cheap-module-source-map",
};
