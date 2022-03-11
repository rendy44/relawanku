const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
    ...defaultConfig,
    entry: {
        metabox: './assets/scripts/metabox.js',
    },
    output: {
        filename: '[name].min.js',
        path: path.resolve(__dirname, 'assets/js')
    }
}
