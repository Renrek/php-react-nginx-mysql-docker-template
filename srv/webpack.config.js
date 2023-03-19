const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");


module.exports = (env) => {

    const isProduction = (env.production !== undefined);
    const isDevelopment = (env.development !== undefined);
    
    return {
        mode: isProduction ? "production" : "development",
        entry: "./src/index.ts",
        output: {
            //filename: "main.[contenthash].js",
            filename: "main.js",
            path: path.resolve(__dirname, "public/js") 
        },
        module: {
            rules: [
                {
                    test: /\.(tsx|ts)$/,
                    use: 'ts-loader',
                    exclude: /node_modules/,
                },
                {
                    test: /\.scss$/,
                    use: ["style-loader", "css-loader", "sass-loader"]
                }
            ]
        },
        resolve: {
            extensions: ['.tsx', '.ts', '.js', '.scss'],
        },
    }
}