const path = require( 'path' );
const webpack = require( 'webpack' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );

const PATHS = {
    build: path.resolve( __dirname, "dist" )
}

module.exports = {
    entry: [
        './src/index.js'
    ],
    output: {
        path: PATHS.build,
        filename: 'bundle.js',
        publicPath: PATHS.build,
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
                loaders: [ 'style-loader', 'css-loader' ],
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
            {
                test: /\.(eot|svg|ttf|woff|woff2)$/,
                loader: 'url-loader?name=/fonts/[name].[ext]'
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
