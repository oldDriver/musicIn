
/** @type {CodeceptJS.MainConfig} */
exports.config = {
  tests: './scenarios/*_test.js',
  output: './output',
  timeout: 30,
  helpers: {
    Puppeteer: {
      url: 'http://localhost:8080/index_test.php',
      show: true,
      windowSize: '1200x900',
      chrome: {
        args: ['--no-sandbox', '--disable-setuid-sandbox'],
        ignoreHTTPSErrors: true
      }
    },
    Page: {
        require: './helper/page_helper.js'
    }
  },
  include: {
    I: './steps_file.js',
    dashboardPage: "./pages/dashboard.js"
  },
  name: 'acceptance'
}