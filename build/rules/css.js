const isdev = require( 'isdev' );
const ExtractTextPlugin = require( "extract-text-webpack-plugin" );

module.exports = {
	test: /\.css$/,
	loaders: [ 'style-loader', 'css-loader' ],
}
