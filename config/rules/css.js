const isdev = require( 'isdev' );

module.exports = {
	test: /\.css$/,
	loaders: [ 'style-loader', 'css-loader' ],
}
