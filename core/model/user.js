var db = require('../database');
var userModel;

userModel = {
  updateForId: function(id, userData, cb) {

    db.where({
      id: id
    }).update(userData).from('users').then(function(user) {
      cb(false, user);
    })

  },

  findByPromotion: function(promotion, cb) {

    db.where({
      promotion: promotion
    }).select().from('users').then(function(users) {
      cb(false, users)
    });

  },

  findOrCreate: function (linkedin_id, userData, cb) {
  
    db.where({
      linkedin_id: linkedin_id,
    }).select().from('users').then(function (user) {
      if (user.length == 0 || typeof user === 'undefined') {
        db('users').insert(userData).then(function (insertedUser) {
          cb(false, insertedUser);
        });
      } else {
        cb(false, user);
      }
    });

  },

  findAll: function(cb) {

    db.select().from('users').then(function (users) {
      cb(false, users)
    });

  },

  findAllStudents(cb) {

    db.select().from('users').where({
      role: 'student'
    }).then(function(users) {
      cb(false, users)
    })

  },

  find: function(userRequest, cb) {

    db.select().from('users').where(userRequest)
      .then(function(users) {
        cb(false, users)
      })

  },

  findOne: function(userRequest, cb) {
    
    db.select().from('users').where(userRequest).limit(1)
      .then(function(user) {
        cb(false, user[0]);
      })

  },

  findById: function(id, cb) {

    return this.findOne({id: id}, cb)

  },

  deleteForId: function(id, cb) {

    db.where({
      id: id
    }).delete().from('users').then(function(user) {
      cb(false, user);
    })

  }
}

module.exports = userModel;