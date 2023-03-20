const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const TerserPlugin = require("terser-webpack-plugin");

module.exports = (env) => {

    const isProduction = (env.production !== undefined);
    const isDevelopment = (env.development !== undefined);

    
    // Note: js files are "cleaned" but css is not
    const plugins = isProduction ? [
        new MiniCssExtractPlugin({filename: "../css/[name].[contenthash].css"})
    ] : [];

    const optimization = isProduction ? { minimizer: [new TerserPlugin()]} : {};
    
    return {
        mode: isProduction ? "production" : "development",
        entry: "./src/main.entry.ts",
        output: {
            filename: isProduction ? "[name].[contenthash].js" : "[name].js",
            path: path.resolve(__dirname, "public/js"),
            clean: true,
        },
        //optimization: isProduction ? { minimizer: [new OptimizeCssAssetsPlugin]} // optimize-css-assets-webpack-plugin
        optimization: optimization,
        plugins: plugins,
        module: {
            rules: [
                {
                    test: /\.(tsx|ts)$/,
                    use: 'ts-loader',
                    exclude: /node_modules/,
                },
                {
                    test: /\.scss$/,
                    use: [
                        isProduction ? MiniCssExtractPlugin.loader : "style-loader", 
                        "css-loader", 
                        "sass-loader"
                    ]
                },
                {
                    test: /\.(svg|png|jpg|gif)$/,
                    use: {
                        loader: "file-loader",
                        options: {
                            name: "[name].[hash].[ext]",
                            outputPath: "img"
                        }
                    }
                }
            ]
        },
        resolve: {
            extensions: ['.tsx', '.ts', '.js', '.scss'],
        },
    }
}