var webpack = require('webpack');

module.exports = {
  entry: './resources/views/react/app.js',
  devtool: 'source-map',
  mode: 'development',
  output: {
    path: __dirname + '/public/scripts',
    filename: 'app.js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      }
    ]
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
      Popper: ['popper.js', 'default']
    })
  ]
}
