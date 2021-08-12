const path = require('path')

module.exports = {
    output: { chunkFilename: 'js/[name].js?id=[chunkhash]'},
    resolve: {
        extensions: [".js", ".jsx", "ts", ".tsx"],
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
            ziggy: path.resolve('vendor/tightenco/ziggy/src/js/route.js')
        },
    }
}
