var express = require('express');
var passport = require('passport');
var _ = require('underscore');
var FB = require('fb');
var routeUtils = require('../utils/route');
var userUtils = require('../utils/user');
var userModel = require('../model/user');

var profilRoutes;


profilRoutes = function () {
  var router = express.Router();

  router.get('/profil', function(req, res) {
    var loggedUser = userUtils.getLoggedUser(req);

    if (loggedUser) {
      res.redirect('/profil/' + loggedUser.id);
    } else {
      res.redirect('/auth/linkedin');
    }
  })

  router.get('/profil/:id', function(req, res) {

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


    userModel.findOne({id: req.params.id}, function(err, result) {
      var user = userUtils.convertDiplomaToPrint(result);
      res.render('profil', 
        {
          messages: req.flash('info'),
          owner: loggedUser ? loggedUser.id == req.params.id : false,
          user: result,
          loggedUser: loggedUser,
          helpers: {
            'select': function(value, options) {
              // Create a select element
              var select = document.createElement('select');

              // Populate it with the option HTML
              select.innerHTML = options.fn(this);

              // Set the value
              select.value = value;

              // Find the selected node, if it exists, add the selected attribute to it
              if (select.children[select.selectedIndex]) {
                select.children[select.selectedIndex].setAttribute('selected', 'selected');
              }

              return select.innerHTML;
            }
          }
        }
      )
    })

  });

  router.post('/profil/:id', function(req, res) {
      
    var loggedUser = userUtils.getLoggedUser(req);

    if (loggedUser.id == req.params.id) {
      userModel.updateForId(req.params.id, req.body, function(err, result) {
        if (err) {
          console.log(err);
        }

        loggedUser = Object.assign(loggedUser, req.body);
        req.session.passport.user = [loggedUser];

        req.flash('info', 'Vos informations ont bien été mises à jour')
        res.redirect('/profil/' + req.params.id);
      })
    } else {
      req.flash('info', 'Veuillez vous reconnecter')
      res.redirect('/profil/' + req.params.id)
    }

  });


  return router;
}

module.exports = profilRoutes;