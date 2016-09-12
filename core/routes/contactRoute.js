var express = require('express');
var nodemailer = require('nodemailer');
var _ = require('underscore');
var routeUtils = require('../utils/route');
var userUtils = require('../utils/user');

var contactRoutes;


contactRoutes = function () {
  var router = express.Router();

  router.get('/contact', function(req, res) {
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
  
    res.render('contact', {
      messages: req.flash('info'),
      loggedUser: loggedUser
    });

  });

  router.post('/contact', function(req, res) {
		var request = req.body;
		var transporter = nodemailer.createTransport('smtps://asso.adis%40gmail.com:inasupien2@smtp.gmail.com');

		var mailOptions = {
	    from: '"' + request.name + '" <' + request.mail + '>', // sender address
	    to: 'asso.adis@gmail.com', // list of receivers
	    subject: request.subject, // Subject line
	    text: request.body, // plaintext body
	    html: request.body, // plaintext body
		};

		transporter.sendMail(mailOptions, function(error, info){
	    if(error){
	        return console.log(error);
	    }
	    req.flash('info', 'Message envoyé');
			return res.redirect('/contact');
		});

  });

  return router;
}

module.exports = contactRoutes;