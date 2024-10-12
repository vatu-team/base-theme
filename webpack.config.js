// WordPress webpack config.
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

// Import the helper to find and generate the entry points in the src directory
const { getWebpackEntryPoints } = require( '@wordpress/scripts/utils/config' );

// Plugins.
const RemoveEmptyScriptsPlugin = require(
	'webpack-remove-empty-scripts'
);

// Utilities.
const path = require( 'path' );

module.exports = (env) => {
	return [
		{
			...defaultConfig,
			name: "Theme",
			entry: {
				...getWebpackEntryPoints,
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
						'global.js' ),
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
				...defaultConfig.plugins,
				new RemoveEmptyScriptsPlugin(
					{
						stage: RemoveEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS
					}
				),
			],
		}
	]
};
