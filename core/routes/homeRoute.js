var express = require('express');
var passport = require('passport');
var _ = require('underscore');
var FB = require('fb');
var routeUtils = require('../utils/route');
var facebookUtils = require('../utils/facebook');
var userUtils = require('../utils/user');
var userModel = require('../model/user');
var _s = require("underscore.string");


var homeRoutes;


homeRoutes = function () {
  var router = express.Router();

  router.get('/', function(req, res) {

    var loggedUser = userUtils.getLoggedUser(req);
    if (loggedUser) {
      if ((loggedUser.promotion == '' || !loggedUser.promotion) && (loggedUser.diplome == '' || !loggedUser.diplome)) {
        req.flash('info', 'Pour apparaitre sur la page Etudiants, veuillez remplir promotion et diplome sur la page profil')
      } else if (loggedUser.promotion == null || !loggedUser.promotion) {
        req.flash('info', 'Pour apparaitre sur la page Etudiants, veuillez remplir promotion sur la page profil')
      } else if (loggedUser.diplome == '' || !loggedUser.diplome) {
        req.flash('info', 'Pour apparaitre sur la page Etudiants, veuillez remplir diplome sur la page profil')
      }
    }

    res.render('home',
      {
        messages: req.flash('info'),
        loggedUser: loggedUser
      }
    ); 
  });

  router.get('/actualites', function(req, res) {

    var loggedUser = userUtils.getLoggedUser(req);
    if (loggedUser) {
      if ((loggedUser.promotion == '' || !loggedUser.promotion) && (loggedUser.diplome == '' || !loggedUser.diplome)) {
        req.flash('info', 'Pour apparaitre sur la page Etudiants, veuillez remplir promotion et diplome sur la page profil')
      } else if (loggedUser.promotion == null || !loggedUser.promotion) {
        req.flash('info', 'Pour apparaitre sur la page Etudiants, veuillez remplir promotion sur la page profil')
      } else if (loggedUser.diplome == '' || !loggedUser.diplome) {
        req.flash('info', 'Pour apparaitre sur la page Etudiants, veuillez remplir diplome sur la page profil')
      }
    }

    facebookUtils.getData(function(err, result) {

      var actus = facebookUtils.getActus(result);

      res.render('index', {
        messages: req.flash('info'),
        actus: actus,
        loggedUser: loggedUser
      });

    })

  });

  router.get('/offres', routeUtils.requireRoleOrRedirect('student', '/'), function(req, res) {

    var loggedUser = userUtils.getLoggedUser(req);
    if (loggedUser) {
      if ((loggedUser.promotion == '' || !loggedUser.promotion) && (loggedUser.diplome == '' || !loggedUser.diplome)) {
        req.flash('info', 'Pour apparaitre sur la page Etudiants, veuillez remplir promotion et diplome sur la page profil')
      } else if (loggedUser.promotion == null || !loggedUser.promotion) {
        req.flash('info', 'Pour apparaitre sur la page Etudiants, veuillez remplir promotion sur la page profil')
      } else if (loggedUser.diplome == '' || !loggedUser.diplome) {
        req.flash('info', 'Pour apparaitre sur la page Etudiants, veuillez remplir diplome sur la page profil')
      }
    }

    facebookUtils.getData(function(err, result) {

      var offres = facebookUtils.getOffres(result);


      _.each(offres, function(value, key) {
        offres[key].message = _s.replaceAll(value.message, "\n", "<br>");
      })

      res.render('index', {
        messages: req.flash('info'),
        offres: offres,
        loggedUser: loggedUser
      });

    })

  });

  router.get('/auth/linkedin', 
    passport.authenticate('linkedin'), 
    function(req, res) {

    });

  router.get('/auth/linkedin/callback', 
    passport.authenticate('linkedin', {
      successRedirect: '/profil', 
      failureRedirect: '/auth/linkedin'
    }));

  return router;
}

module.exports = homeRoutes;