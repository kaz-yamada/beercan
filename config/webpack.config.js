const path = require("path");
const webpack = require("webpack");
const isdev = require("isdev");
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
// const UglifyJsPlugin = require("uglifyjs-webpack-plugin");

const sassRule = require("./rules/sass");
const cssRule = require("./rules/css");
const fontsRule = require("./rules/fonts");
// const imagesRule = require( './rules/images' );
const javascriptRule = require("./rules/javascript");
// const externalFontsRule = require( './rules/external.fonts' );
// const externalImagesRule = require( './rules/external.images' );

const PATHS = {
  build: path.resolve(__dirname, "../dist")
};

module.exports = {
  entry: ["./src/index.js"],
  output: {
    path: PATHS.build,
    filename: "bundle.js",
    publicPath: PATHS.build
  },
  devtool: isdev ? "source-map" : undefined,
  module: {
    rules: [
      javascriptRule,
      cssRule,
      sassRule,
      fontsRule
      // imagesRule,
    ]
  },
  plugins: [
    new ExtractTextPlugin("main.css")
    //   new UglifyJsPlugin()
  ]
};

module.exports.plugins.push(new ExtractTextPlugin("main.css"));

module.exports.plugins.push(
  new BrowserSyncPlugin({
    proxy: "localhost/blogsite",
    files: ["**/*.php"],
    reloadDelay: 0
  })
);

/* Production Plugins */
if (!isdev) {
  //   module.exports.plugins.push(new UglifyJsPlugin());
}
