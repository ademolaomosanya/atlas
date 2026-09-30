const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

const pluginDir = path.resolve(
	__dirname,
	'wordpress/wp-content/plugins/atlas'
);

module.exports = {
	...defaultConfig,
	entry: {
		index: path.resolve(pluginDir, 'src/index.js'),
		'feature-card': path.resolve(
			pluginDir,
			'blocks/feature-card/src/index.js'
		),
	},
	output: {
		...defaultConfig.output,
		path: path.resolve(pluginDir, 'build'),
	},
};
