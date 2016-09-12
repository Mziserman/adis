
exports.up = function(knex, Promise) {
  return Promise.all([ 
    knex.schema.table('users', function (table) {
      table.string('headline');
      table.string('profil');
    })
  ]);
};

exports.down = function(knex, Promise) {
  
};
