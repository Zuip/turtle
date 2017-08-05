module.exports = {
  entry: './blog/resources/views/react/app.js',
  devtool: 'source-map',
  output: {
    filename: './public_html/scripts/app.bundle.js'
  },
  module: {
    loaders: [
      {
		test: /\.js$/,
		loader: 'babel-loader',
		exclude: /node_modules/
	  },
      {
		test: /\.jsx$/,
		loader: 'babel-loader',
		exclude: /node_modules/
      }
    ]
  },
}