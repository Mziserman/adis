var express = require('express');
var favicon = require('serve-favicon');
var path = require('path');
var bodyParser = require('body-parser');

var hbs = require('express-hbs');
var flash = require('connect-flash');

var passport = require('passport');
var LinkedInStrategy = require('passport-linkedin-oauth2').Strategy;

var userModel = require('./model/user');

var session = require('express-session');
var cookie = require('cookie-parser')

var env = process.env.NODE_ENV || 'development';
var routes = require('./routes');

var linkedinUtils = require('./utils/linkedin');

module.exports = function (app) {

  app.use(session({
    secret: 'qslifqmklshdgmk cat', key: 'sid', cookie: {
      secure: false,
      httpOnly: true
    }
  }));

  app.engine('hbs', hbs.express4({
    partialsDir: './client/views/partials'
  }));
  app.set('views', './client/views');
  app.set('view engine', 'hbs');

  hbs.registerHelper('select', function (selected, options) {
    return options.fn(this).replace(
      new RegExp(' value=\"' + selected + '\"'),
      '$& selected="selected"');
  });



  app.use(express.static(__dirname + '/client/'));
  app.use(bodyParser.json());
  app.use(bodyParser.urlencoded({
    extended: false
  }));
  app.use(express.static(path.join(path.normalize(__dirname + '/..'), 'client')));

  passport.serializeUser(function (user, done) {
    done(null, user);
  });

  passport.deserializeUser(function (obj, done) {
    done(null, obj);
  });

  app.use(passport.initialize());
  app.use(passport.session());
  app.use(flash());
  app.use(cookie());

  app.use('/', routes.homeRoute());
  app.use('/', routes.adminRoute());
  app.use('/', routes.profilRoute());
  app.use('/', routes.contactRoute());
  app.use('/', routes.studentRoute());

  passport.use(new LinkedInStrategy({
    clientID: "77s899qhhimkbr",
    clientSecret: "GzVxFh5WUw0IQZtg",
    /*callbackURL: "http://127.0.0.1:1984/auth/linkedin/callback",
    */callbackURL: "http://adis.eu-west-1.elasticbeanstalk.com/auth/linkedin/callback",
    scope: ['r_basicprofile', 'r_emailaddress'],
    state: true
  }, function (accessToken, refreshToken, profile, done) {
    var parsedProfile = linkedinUtils.parse(profile);
    userModel.findOrCreate(profile.id, parsedProfile, function (err, user) {
      return done(err, user);
    });
  }));
}