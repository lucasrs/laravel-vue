var webpack = require('webpack');
module.exports = {
  plugins: [
      new webpack.ProvidePlugin({
          'window.$': 'jquery',
          'window.jQuery': 'jquery'
      })
  ]
}
