const path = require('path');

module.exports = {
    mode: "production", // mode: "development"
    entry: "./src/index.ts",
    output: {
        filename: "main.[contenthash].js",
        path: path.resolve(__dirname, "public/js") 
    },
    module: {
        rules: [
            {
                test: /\.tsx?$/,
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
        extensions: ['.tsx', '.ts', '.js'],
    },
}