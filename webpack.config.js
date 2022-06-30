const path          = require( 'path' );
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	entry: {
		app: './assets/scripts/app.js',
		metabox: './assets/scripts/metabox.js',
		admin: './assets/scripts/admin.js',
		reactRegister: './assets/scripts/react/register/main.js',
	},
	output: {
		filename: '[name].min.js',
		path: path.resolve( __dirname, 'assets/js' )
	}
}
