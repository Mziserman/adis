/**
 * Boilerplate Express App
 * Index Route
 * Arnaud Allouis aka Baloran
 */

var homeRoute = require('./homeRoute');
var adminRoute = require('./adminRoute');
var profilRoute = require('./profilRoute');
var contactRoute = require('./contactRoute');
var studentRoute = require('./studentRoute');

module.exports = {
  homeRoute: homeRoute,
  adminRoute: adminRoute,
  profilRoute: profilRoute,
  contactRoute: contactRoute,
  studentRoute: studentRoute
};