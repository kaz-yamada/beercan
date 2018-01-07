const path = require( 'path' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );
const webpack = require( 'webpack' );

module.exports = {
    entry: {
        app: './src/index.js',
    },
    output: {
        path: path.resolve( __dirname, "dist" ),
        filename: 'bundle.js'
    },
    devtool: 'source-map',
    module: {
        rules: [ {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [ 'babel-preset-env' ]
                    }
                }
            },
            {
                test: /\.css$/,
                loader: "style-loader!css-loader",
                exclude: /node_modules/
            },
            {
                test: /\.scss$/,
                exclude: /node_modules/,
                use: ExtractTextPlugin.extract( {
                    fallback: 'style-loader',
                    use: [ {
                            loader: 'css-loader',
                            options: {
                                url: false,
                                minimize: true,
                                sourceMap: true
                            }
                        },
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: true
                            }
                        }
                    ]
                } )
            },
        ]
    },
    plugins: [
        new ExtractTextPlugin( '[name].css' ),
        new BrowserSyncPlugin( {
            proxy: 'localhost/blogsite',
            files: [
                '**/*.php'
            ],
            reloadDelay: 0
        } ),
    ]
}
