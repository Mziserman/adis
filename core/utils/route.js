'use strict';

var routeUtils = {
  requireRoleOrRedirect(role, redirect) {
    return function (req, res, next) {
      if (req.user && (req.user[0].role === "admin" || (req.user[0].role === role && req.user[0].validated == 1))) {
        next();
      } else {
        req.flash('info', 'Vous n\'avez pas le droit lol :p')
        res.redirect(redirect);
      }
    }
  }
};

module.exports = routeUtils;