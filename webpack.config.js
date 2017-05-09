var path = require('path');

module.exports = {
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [{
          loader: "style-loader" // creates style nodes from JS strings
        }, {
          loader: "css-loader" // translates CSS into CommonJS
        }, {
          loader: "sass-loader" // compiles Sass to CSS
        }]
      },
      {
        test: /\.mustache$/,
        use: 'raw-loader'
      }
    ]
  },
  entry: './frontend/js/index.js',
  output: {
    filename: './web/assets/js/bundle.js',
  }
}
