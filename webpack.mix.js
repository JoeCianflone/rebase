const mix = require('laravel-mix');
const path = require('path');
const LiveReloadPlugin = require('webpack-livereload-plugin');
const imageminPlugin = require('imagemin-webpack-plugin').default;
const copyWebpackPlugin = require('copy-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');


mix
    .sass(`${process.env.MIX_INPUT_STYLE}/app.scss`, process.env.MIX_OUTPUT_STYLE)
    .js(`${process.env.MIX_INPUT_JS}/app.js`, process.env.MIX_OUTPUT_JS)
    .options({
        processCssUrls: false,
        postCss: [
           require('postcss-import')(),
           require('css-mqpacker')(),
           require('autoprefixer')(),
           require('cssnano')({
              "preset": [
                 "default",
                 {
                    calc: false,
                    discardComments: {removeAll: true},
                    normalizeWhitespace: false
                 }
              ]
           })
        ]
    })
    .webpackConfig({
        output: { chunkFilename: 'assets/js/[name].js?id=[chunkhash]' },
        resolve: {
            alias: {
                'vue$': 'vue/dist/vue.runtime.esm.js',
                '@': path.resolve(process.env.MIX_INPUT_JS),
            },
        },
        plugins: [
            new LiveReloadPlugin(),
            new copyWebpackPlugin([{
                from: process.env.MIX_INPUT_IMAGES,
                to: process.env.MIX_OUTPUT_IMAGES
            }]),
            new copyWebpackPlugin([{
                from: process.env.MIX_INPUT_FONTS,
                to: process.env.MIX_OUTPUT_FONTS
            }]),
            new copyWebpackPlugin([{
                from: process.env.MIX_INPUT_FILES,
                to: process.env.MIX_OUTPUT_FILES
            }]),
            new imageminPlugin({
                test: /\.(jpe?g|png|gif|svg)$/i,
                plugins: [
                    imageminMozjpeg({
                        quality: 80
                    })
                ]
            })
        ]
    })
    .babelConfig({
        plugins: ['@babel/plugin-syntax-dynamic-import'],
    })
    .version()
    .sourceMaps(true, 'source-maps')
