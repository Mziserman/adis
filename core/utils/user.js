'use strict';

var _ = require('underscore');

var userUtils = {
  replaceOneByChecked(userArray) {
    for (var i = 0; i < userArray.length; i++) {
      if (userArray[i]['validated'] == 1) {
        userArray[i]['validated'] = "checked";
      }
    }
    return userArray;
  },

  prepareUserForUpdate(returnedUser) {
    var user = {
      username: returnedUser.username,
      first_name: returnedUser.first_name,
      last_name: returnedUser.last_name,
      profile_pictures: returnedUser.profile_pictures,
      email: returnedUser.email,
      headline: returnedUser.headline,
      profil: returnedUser.profil,
      role: returnedUser.role,
      validated: returnedUser.validated == "on" ? 1 : 0,
    };
    return {
      id: returnedUser.user_id,
      user: user
    }
  },

  splitByPromotion(userArray) {
    var splitedUsers = {};
    _.map(userArray, function (student) {
      if (student.promotion != null && student.promotion != "") {
        if (!splitedUsers[student.promotion]) {
          splitedUsers[student.promotion] = [student];
        } else {
          splitedUsers[student.promotion].push(student);
        }
      }
    });

    return splitedUsers;
  },

  splitByDiplome(userArray) {
    var splitedUsers = {};
    _.map(userArray, function (student) {
      if (student.diplome == "archive" || student.diplome == "production") {
        if (!splitedUsers[student.diplome]) {
          splitedUsers[student.diplome] = [student];
        } else {
          splitedUsers[student.diplome].push(student);
        }
      }
    })

    return splitedUsers;
  },

  removeEmptyValues(user) {

    if (user.first_name == '') {
      delete user.first_name;
    }
    if (user.last_name == '') {
      delete user.last_name;
    }
    if (user.diplome == '') {
      delete user.diplome;
    }
    if (user.promotion == '') {
      delete user.promotion;
    }
    if (user.validated == '') {
      delete user.validated;
    }
    return user;
  },

  splitStudentsAndAdmins(userArray) {
    var splitedUsers = {
      admins: [],
      students: []
    };
    for (var i = 0; i < userArray.length; i++) {
      console.log(userArray[i])
      if (userArray[i]['role'] == "admin") {
        splitedUsers.admins.push(userArray[i])
      }

      if (userArray[i]['role'] == "student") {
        splitedUsers.students.push(userArray[i])
      }

    }


    return splitedUsers;
  },

  convertDiplomaToBool(user) {
    if (user.diplome == 'archive') {
      user.archive = true;
      delete user.diplome;
    } else if (user.diplome == 'production') {
      user.production = true;
      delete user.diplome;
    }
  },


  convertDiplomaToPrint(user) {
    if (user.diplome == 'archive') {
      user.diplome = 'Gestion de patrimoines audiovisuels';
      user.diplomeSlug = 'archive';
    } else if (user.diplome == 'production') {
      user.diplome = 'Production';
      user.diplomeSlug = 'production';
    }

    return user;
  },

  convertBoolToDiploma(user) {
    if (user.archive) {
      user.diplome = 'archive';
      delete user.archive;
    } else if (user.production) {
      user.diplome = 'production';
      delete user.production;
    }

    return user;
  },

  getLoggedUser(req) {
    var loggedUser = req.user ? req.user[0] : false;

    if (typeof loggedUser === 'number') {
      loggedUser = {
        id: loggedUser
      };
    }
    ;

    return loggedUser;
  },

  update(user, newUser) {

  }
}

module.exports = userUtils;