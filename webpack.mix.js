const mix = require('laravel-mix');
const path = require('path');
const LiveReloadPlugin = require('webpack-livereload-plugin');
const imageminPlugin = require('imagemin-webpack-plugin').default;
const copyWebpackPlugin = require('copy-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');

// Folders
const INPUT_SASS ='resources/css';
const INPUT_JS = 'resources/js'
const INPUT_FONTS = 'resources/fonts'
const INPUT_IMAGES = 'resources/images'
const INPUT_FILES = 'resources/files'

const OUTPUT_JS = 'public/assets/js';
const OUTPUT_CSS = 'public/assets/css';
const OUTPUT_FONTS = 'public/assets/fonts';
const OUTPUT_IMAGES = 'public/assets/images';
const OUTPUT_FILES = 'public/assets/files';

mix
    .sass(`${INPUT_SASS}/app.scss`, OUTPUT_CSS)
    .js(`${INPUT_JS}/app.js`, OUTPUT_JS)
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
                '@': path.resolve(INPUT_JS),
            },
        },
        plugins: [
            new LiveReloadPlugin(),
            new copyWebpackPlugin([{
                from: INPUT_IMAGES,
                to: OUTPUT_IMAGES
            }]),
            new copyWebpackPlugin([{
                from: INPUT_FONTS,
                to: OUTPUT_FONTS
            }]),
            new copyWebpackPlugin([{
                from: INPUT_FILES,
                to: OUTPUT_FILES
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
