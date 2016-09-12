var express = require('express');
var passport = require('passport');
var _ = require('underscore');
var FB = require('fb');
var routeUtils = require('../utils/route');
var userUtils = require('../utils/user');
var userModel = require('../model/user')

var studentRoutes;


studentRoutes = function () {
  var router = express.Router();

  router.post('/etudiants', function(req, res) {
    var loggedUser = userUtils.getLoggedUser(req);
    if (loggedUser) {
      if ((loggedUser.promotion == '' || !loggedUser.promotion) && (loggedUser.diplome == '' || !loggedUser.diplome)) {
        req.flash('info', 'Pour apparaitre sur la page Adhérents, veuillez remplir promotion et diplome sur la page profil')
      } else if (loggedUser.promotion == null || !loggedUser.promotion) {
        req.flash('info', 'Pour apparaitre sur la page Adhérents, veuillez remplir promotion sur la page profil')
      } else if (loggedUser.diplome == '' || !loggedUser.diplome) {
        req.flash('info', 'Pour apparaitre sur la page Adhérents, veuillez remplir diplome sur la page profil')
      }
    }

    var userRequest = req.body;

    var cleanUserRequest = userUtils.removeEmptyValues(userRequest);

    userModel.find(cleanUserRequest, function(err, result) {


      if (err) {
        console.log(err);
      }
      var splitedByPromotion = userUtils.splitByPromotion(result);

      var splitedStudents = [];

      _.each(splitedByPromotion, function(val, key) {
        splitedStudents[key] = (userUtils.splitByDiplome(val));
      })

      res.cookie('searchResult', {
        students: splitedStudents,
        loggedUser: loggedUser
      });

      res.redirect('/etudiants/resultat');

    })

  });

  router.get('/etudiants/resultat', function(req, res) {

    var loggedUser = userUtils.getLoggedUser(req);
    if (loggedUser) {
      if ((loggedUser.promotion == '' || !loggedUser.promotion) && (loggedUser.diplome == '' || !loggedUser.diplome)) {
        req.flash('info', 'Pour apparaitre sur la page Adhérents, veuillez remplir promotion et diplôme sur la page profil')
      } else if (loggedUser.promotion == null || !loggedUser.promotion) {
        req.flash('info', 'Pour apparaitre sur la page Adhérents, veuillez remplir promotion sur la page profil')
      } else if (loggedUser.diplome == '' || !loggedUser.diplome) {
        req.flash('info', 'Pour apparaitre sur la page Adhérents, veuillez remplir diplôme sur la page profil')
      }
    }

    var students = req.cookies.searchResult.students;
    
    res.render('students',
        {
          messages: req.flash('info'),
          students: students,
          loggedUser: loggedUser
        }
      );

  });

  router.get('/etudiants', function(req, res) {

    var loggedUser = userUtils.getLoggedUser(req);
    if (loggedUser) {
      if ((loggedUser.promotion == '' || !loggedUser.promotion) && (loggedUser.diplome == '' || !loggedUser.diplome)) {
        req.flash('info', 'Pour apparaitre sur la page Adhérents, veuillez remplir promotion et diplome sur la page profil')
      } else if (loggedUser.promotion == null || !loggedUser.promotion) {
        req.flash('info', 'Pour apparaitre sur la page Adhérents, veuillez remplir promotion sur la page profil')
      } else if (loggedUser.diplome == '' || !loggedUser.diplome) {
        req.flash('info', 'Pour apparaitre sur la page Adhérents, veuillez remplir diplome sur la page profil')
      }
    }

    userModel.findAll(function(err, result) {
      if (err) {
        console.log(err);
      }
      var splitedByPromotion = userUtils.splitByPromotion(result);

      var splitedStudents = [];

      _.each(splitedByPromotion, function(val, key) {
        splitedStudents[key] = (userUtils.splitByDiplome(val));
      })

      _.each(splitedStudents, function(promotion) {
        _.each(promotion, function(diplome) {
          _.each(diplome, function(student) {
            userUtils.convertDiplomaToPrint(student)
          })
        })
      })
      
      res.render('students',
        {
          messages: req.flash('info'),
          students: splitedStudents,
          loggedUser: loggedUser
        }
      );
    })

  });

  return router;
}

module.exports = studentRoutes;