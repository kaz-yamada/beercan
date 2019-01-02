const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  //test: /\.(sa|sc|c)ss$/,
  test: /\.(css|sass|scss)$/,
  use: [
    MiniCssExtractPlugin.loader,
    {
      loader: "css-loader",
      options: {
        importLoaders: 2,
        sourceMap: true
      }
    },
    {
      loader: "sass-loader",
      query: {
        includePaths: [require("path").resolve(__dirname, "node_modules")]
      }
    }
  ]
};
