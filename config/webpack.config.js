const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

const sassRule = require("./rules/sass");
const fontsRule = require("./rules/fonts");
const javascriptRule = require("./rules/javascript");

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
  devtool: "source-map",
  module: {
    rules: [
      javascriptRule,
      //cssRule,
      sassRule,
      fontsRule
      // imagesRule,
    ]
  },
  plugins: [
    new MiniCssExtractPlugin("app.css"),
    new BrowserSyncPlugin({
      proxy: "http://192.168.33.10/wordpress",
      host: "localhost",
      port: 3000,
      files: ["**/*.php"],
      reloadDelay: 0
    })
  ]
};
