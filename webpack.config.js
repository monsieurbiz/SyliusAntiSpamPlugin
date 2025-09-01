const Encore = require('@symfony/webpack-encore');

Encore
  // directory where compiled assets will be stored
  .setOutputPath('src/Resources/public')
  // public path used by the web server to access the output path
  .setPublicPath('/public')

  // entries
  .addEntry('altcha', './assets/js/altcha.js')
  .addEntry('altcha-i18n', './assets/js/altcha-i18n.js')

  // configuration
  .disableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())

  // organise files
  .configureFilenames({
    js: 'js/[name].js',
    css: 'css/[name].css',
  })
  .configureImageRule({
    type: 'asset',
    filename: `images/[name].[ext]`,
  })
;

module.exports = Encore.getWebpackConfig();
