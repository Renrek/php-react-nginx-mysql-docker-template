const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");


module.exports = (env) => {

    const isProduction = (env.production !== undefined);
    const isDevelopment = (env.development !== undefined);

    let plugins = [];
    // Note: new MiniCssExtractPlugin({filename: "[name].[contenthash].css"})
    plugins = isProduction ? [new MiniCssExtractPlugin({filename: "../css/[name].css"})] : [];
    
    return {
        mode: isProduction ? "production" : "development",
        entry: "./src/main.entry.ts",
        output: {
            //filename: "main.[contenthash].js",
            filename: "main.js",
            path: path.resolve(__dirname, "public/js") 
        },
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
                }
            ]
        },
        resolve: {
            extensions: ['.tsx', '.ts', '.js', '.scss'],
        },
    }
}