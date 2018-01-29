/**
 * Internal application image files. This rule exceptionally don't emit its files,
 * because they are handled by copy and image-minify webpack plugins.
 */
module.exports = {
    test: /\.(png|jpe?g|gif|svg)$/,
    loader: 'file-loader',
    options: {
        publicPath: config.paths.relative,
        name: config.outputs.image.filename,
        emitFile: false
    }
}
