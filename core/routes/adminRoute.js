var express = require('express');
var passport = require('passport');
var _ = require('underscore');
var FB = require('fb');
var routeUtils = require('../utils/route');
var userUtils = require('../utils/user');
var userModel = require('../model/user')

var adminRoutes;


adminRoutes = function () {
  var router = express.Router();
  
  router.get('/admin', routeUtils.requireRoleOrRedirect('admin', '/'), function(req, res) {

    var loggedUser = userUtils.getLoggedUser(req);

    userModel.findAll(function(err, result) {
      if (err) {
        console.log(err);
      }

      var splitedUsers = userUtils.splitStudentsAndAdmins(result);

      var preparedUsers = {};
      preparedUsers.admins = userUtils.replaceOneByChecked(splitedUsers.admins);
      preparedUsers.students = userUtils.replaceOneByChecked(splitedUsers.students);


      res.render('admin', {
        messages: req.flash('info'),
        students: preparedUsers.students,
        admins: preparedUsers.admins,
        loggedUser: loggedUser
      }) 
    });
  });

  router.post('/admin/search', routeUtils.requireRoleOrRedirect('admin', '/'), function(req, res) {

    var userRequest = req.body;
    var cleanUserRequest = userUtils.removeEmptyValues(userRequest);

    userModel.find(cleanUserRequest, function(err, result) {

      if (err) {
        console.log(err);
      }

      var splitedUsers = userUtils.splitStudentsAndAdmins(result);


      var preparedUsers = {};
      preparedUsers.admins = userUtils.replaceOneByChecked(splitedUsers.admins);
      preparedUsers.students = userUtils.replaceOneByChecked(splitedUsers.students);

      res.cookie('searchResult', {
        students: preparedUsers.students,
        admins: preparedUsers.admins
      });

      res.redirect('/admin/resultat');

    });
  });

  router.get('/admin/resultat', function(req, res) {

    var loggedUser = userUtils.getLoggedUser(req);

    var students = req.cookies.searchResult.students;
    var admins = req.cookies.searchResult.admins;
    
    res.render('admin',
        {
          messages: req.flash('info'),
          admins: admins,
          students: students,
          loggedUser: loggedUser
        }
      );

  });


  router.post('/admin/update', routeUtils.requireRoleOrRedirect('admin', '/'), function(req, res) {

    var user = userUtils.prepareUserForUpdate(req.body);

    userModel.updateForId(user.id, user.user, function(err) {
      if (err) {
        console.log(err);
      }
    })

    res.redirect('/admin');
  });


  router.get('/admin/update/:id', routeUtils.requireRoleOrRedirect('admin', '/'), function(req, res) {

    var loggedUser = userUtils.getLoggedUser(req);

    userModel.find({id: req.params.id}, function(err, result) {

      res.render('adminUpdate',
        {
          messages: req.flash('info'),
          user: result[0],
          loggedUser: loggedUser
        }
      );

    });

  });

  router.get('/admin/delete/:id', routeUtils.requireRoleOrRedirect('admin', '/'), function(req, res) {

    var user = userModel.deleteForId(req.params.id, function(err) {
      if (err) {
        console.log(err);
      }
    });

    res.redirect('/admin');

  });
  return router;
}

module.exports = adminRoutes;