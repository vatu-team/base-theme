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

// Utilities.
const path = require( 'path' );
const { globSync } = require( 'glob' );

// Block Custom Stylesheets.
const blockStylesheets = () => {
	return globSync(`./resources/css/blocks/*.css`).reduce(
		(files, filepath) => {
			const name = path.parse(filepath).name;

			files[`css/blocks/${name}`] = path.resolve(
				process.cwd(),
				`resources/css/blocks`,
				`${name}.css`
			);

			return files;
		}, {}
	)
};

module.exports = (env) => {
	return [
		{
			...defaultConfig,
			name: "Theme",
			entry: {
				...getWebpackEntryPoints,
				...blockStylesheets(),
				editor: {
					import: path.resolve(
						process.cwd(),
						'resources/js/',
						'editor.js'
					),
					filename: 'js/[name].js',
				},
				global: {
					import: path.resolve(
						process.cwd(),
						'resources/js/',
						'global.js'
					),
					filename: 'js/[name].js',
				},
				'css/global': {
					import: path.resolve(
						process.cwd(),
						'resources/css/',
						'global.css'
					),
				}
			},
			output: {
				...defaultConfig.output,
				path: path.resolve(__dirname, './assets/')
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
				// new CopyPlugin({
				// 	patterns: [
				// 		{
				// 			from: 'public/app/themes/cuilbay-foundation/resources/fonts',
				// 			to: 'fonts'
				// 		},
				// 		{
				// 			from: 'public/app/themes/cuilbay-foundation/resources/svg',
				// 			to: 'svg'
				// 		},
				// 	],
				// }),
			],
		}
	]
};
