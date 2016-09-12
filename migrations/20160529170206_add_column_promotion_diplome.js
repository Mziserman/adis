
exports.up = function(knex, Promise) {
  return Promise.all([ 
    knex.schema.table('users', function (table) {
      table.string('promotion');
      table.string('diplome');
    })
  ]);
};

exports.down = function(knex, Promise) {
  return Promise.all([ 
    knex.schema.table('users', function (table) {
      table.dropColumn('promotion');
      table.dropColumn('diplome');
    })
  ]);
};
