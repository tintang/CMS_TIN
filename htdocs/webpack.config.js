// ./webpack.config.js

var Encore = require('@symfony/webpack-encore');
const path = require('path');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/main.js')
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableVueLoader(()=> {}, {
        version: 3
    })
    .addAliases({
        '@style': path.resolve('./assets/css/components/'),
    })
    .enableSassLoader()
    .enableBabelTypeScriptPreset()
;

module.exports = Encore.getWebpackConfig();