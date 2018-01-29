const isdev = require( 'isdev' );
const ExtractTextPlugin = require( "extract-text-webpack-plugin" );

module.exports = {
    test: /\.s[ac]ss$/,
    loader: ExtractTextPlugin.extract( {
        use: [ {
                loader: 'css-loader',
                options: {
                    url: false,
                    minimize: isdev,
                    sourceMap: true
                }
            },
            {
                loader: 'sass-loader',
                options: {
                    sourceMap: true
                }
            }
        ],
        fallback: 'style-loader'
    } )
}
