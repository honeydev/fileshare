'use strict';

const NODE_ENV = process.env.NODE_ENV || 'development';
const webpack = require('webpack');

module.exports = {
    context: __dirname + '/js/app/',
    entry: {
        main: './mainpage/main',
        tests: '../tests/bootstrap'
    },
    output: {
        filename: '[name].js',
        path: __dirname + '/js/public'
    },
    devtool: 'inline-source-map',
    watch: true,
    watchOptions: {
        poll: true,
        aggregateTimeout: 100
    },
    plugins: [
        new webpack.NoEmitOnErrorsPlugin(),
        new webpack.EnvironmentPlugin('NODE_ENV'),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
            Popper: ['popper.js', 'default'],
        }),
        new webpack.ProvidePlugin({
            bootstrap: "bootstrap.css",
        }),
        new webpack.ProvidePlugin({
            dic: 'dic/dic.js'
        }),
        new webpack.ProvidePlugin({
            chai: 'chai/chai.js'
        })
    ],
    node: {
        fs: 'empty'
    },
    resolve: {
        modules: ['node_modules'],
        extensions: ['.js'],
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    { loader: "style-loader" },
                    { loader: "css-loader" }
                ]
            },
            {
                test: /\.(png|svg|jpg|gif)$/,
                use: [
                    'file-loader'
                ]
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/,
                use: [
                    //set manual path to fonts
                    'file-loader?name=[name].[ext]&publicPath=/js/public/&mimetype=application/font-woff2'
                ]
            }
        ]
    }
};