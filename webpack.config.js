const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = (env, argv) => {
  const isProduction = argv.mode === 'production';

  return {
    entry: './assets/js/scripts.js',
    output: {
      filename: 'main.js',
      path: path.resolve(__dirname, 'dist'),
      clean: true, 
    },
    module: {
      rules: [
        {
          test: /\.scss$/i,
          use: [
            MiniCssExtractPlugin.loader,
            'css-loader',
            {
              loader: 'postcss-loader',
              options: {
                postcssOptions: {
                  plugins: [
                    require('autoprefixer')()
                  ]
                }
              }
            },
            'sass-loader'
          ],
        },
        {
          test: /\.js$/i,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader', 
          }
        }
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: isProduction ? 'style.[contenthash].css' : 'style.css',
      }),
    ],
    devtool: isProduction ? false : 'source-map',
    mode: isProduction ? 'production' : 'development'
  };
};
