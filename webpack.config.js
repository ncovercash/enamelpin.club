const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const PurgecssPlugin = require("purgecss-webpack-plugin")
const glob = require("glob-all")

const SpeedMeasurePlugin = require("speed-measure-webpack-plugin");

const smp = new SpeedMeasurePlugin({
	options: {
		granularLoaderData: true,
	},
});

module.exports = smp.wrap({
	mode: "development",
	entry: "./src/js/entry.ts",
	output: {
		filename: "js/webpack.js",
		path: path.resolve(__dirname, "dist/"),
	},
	resolve: {
		extensions: [".ts", ".tsx", ".js", ".pcss"],
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
				test: /\.pcss$/,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: "css-loader",
						options: {
							sourceMap: false,
						},
					},
					{
						loader: "postcss-loader",
						options: {
							sourceMap: false,
						},
					},
				],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "css/styles.css",
		}),
		// new PurgecssPlugin({
		// 	paths: glob.sync([
		// 			"www/**",
		// 			"src/js/**",
		// 			"src/php/**",
		// 		], {nodir: true}),
		// }),
	],
	devtool: "eval-cheap-module-source-map",
	stats: "detailed",
});
