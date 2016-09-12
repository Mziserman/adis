/**
 * Boilerplate Express App
 * app.js
 * Arnaud Allouis aka Baloran
 */

// Require Express
var express = require('express')

// App
var app = express();

// Configuration
require('./core/bootstrap')(app);

var port = process.env.PORT || 1984;

// Start the app by listening on <port>
app.listen(port, function () {
  console.log('Boilerplate started on port ' + port);
});

// Expose app
exports = module.exports = app;