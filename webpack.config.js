// WordPress webpack config.
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

// Import the helper to find and generate the entry points in the src directory
const { getWebpackEntryPoints } = require( '@wordpress/scripts/utils/config' );

// Plugins.
const CopyPlugin = require(
	'copy-webpack-plugin'
);

const RemoveEmptyScriptsPlugin = require(
	'webpack-remove-empty-scripts'
);

const RtlCssPlugin = require(
	'rtlcss-webpack-plugin'
);

const SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');

// Utilities.
const path = require( 'path' );
const { globSync } = require( 'glob' );

// Custom Settings.
const ThemePath = path.resolve("./");

// Block Custom Stylesheets.
const blockStylesheets = () => {
	return globSync(ThemePath + "/resources/css/blocks/*.css").reduce(
		(files, filepath) => {
			const name = path.parse(filepath).name;

			files[`css/blocks/${name}`] = path.resolve(
				ThemePath,
				`resources/css/blocks`,
				`${name}.css`,
			);

			return files;
		},
		{},
	);
};

module.exports = (env) => {
	return [
		{
			...defaultConfig,
			name: "Theme",
			module: {
				rules: [
					...defaultConfig.module.rules,
				],
			},
			entry: {
				...getWebpackEntryPoints,
				...blockStylesheets(),
				editor: {
					import: path.resolve(ThemePath, "resources/js/", "editor.js"),
					filename: "js/[name].js",
				},
				global: {
					import: path.resolve(ThemePath, "resources/js/", "global.js"),
					filename: "js/[name].js",
				},
				"css/global": {
					import: path.resolve(ThemePath, "resources/css/", "global.css"),
				},
				"css/editor": {
					import: path.resolve(ThemePath, "resources/css/", "editor.css"),
				},
			},
			output: {
				...defaultConfig.output,
				path: ThemePath + "/assets/",
			},
			plugins: [
				...defaultConfig.plugins.filter(
					(filter) => ! (filter instanceof RtlCssPlugin)
				),
				new RemoveEmptyScriptsPlugin(
					{
						stage: RemoveEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS
					}
				),
				new CopyPlugin({
					patterns: [
						{
							from: ThemePath + "resources/svg/*.svg",
							to: "svg/[name][ext]",
							noErrorOnMissing: true,
						},
						{
							from: ThemePath + "resources/fonts/",
							to: "fonts/",
							noErrorOnMissing: true
						},
						{
							from: ThemePath + "/resources/images",
							to: ThemePath + "/assets/images",
							noErrorOnMissing: true,
						},
					],
				}),
				new SVGSpritemapPlugin(
					[ ThemePath + '/resources/svg/icons/*.svg' ],
					{
						input: {},
						output: {
							filename: '/svg/icons.svg',
							svg: {},
							svgo: true,
						},
						sprite: {
							prefix: false,
							gutter: false,
							generate: {
								title: false,
							}
						}
					}
				),
			],
		}
	]
};
