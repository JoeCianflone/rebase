const mix = require("laravel-mix")
const path = require("path")
const LiveReloadPlugin = require("webpack-livereload-plugin")

mix.sass(
   `${process.env.MIX_INPUT_STYLE}/app.scss`,
   process.env.MIX_OUTPUT_STYLE
)
   .js(`${process.env.MIX_INPUT_JS}/app.js`, process.env.MIX_OUTPUT_JS)
   .options({
      extractVueStyles: true,
      cssNano: {
         calc: false,
         discardComments: { removeAll: true },
         normalizeWhitespace: false,
      },
      processCssUrls: false,
      postCss: [
         require("postcss-import")(),
         require("postcss-sort-media-queries")(),
      ],
   })
   .webpackConfig({
      output: { chunkFilename: "assets/js/[name].js?id=[chunkhash]" },
      resolve: {
         alias: {
            vue$: "vue/dist/vue.runtime.esm.js",
            "@": path.resolve(process.env.MIX_INPUT_JS),
            "@@": path.resolve(process.env.MIX_INPUT_STYLE),
         },
      },
      plugins: [new LiveReloadPlugin()],
   })
   .copy(process.env.MIX_INPUT_FILES, process.env.MIX_OUTPUT_FILES)
   .copy(process.env.MIX_INPUT_IMAGES, process.env.MIX_OUTPUT_IMAGES)
   .copy(process.env.MIX_INPUT_FONTS, process.env.MIX_OUTPUT_FONTS)
   .babelConfig({
      plugins: ["@babel/plugin-syntax-dynamic-import"],
   })
   .version()
   .sourceMaps(true, "source-maps")
