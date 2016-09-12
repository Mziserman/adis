var knex = require('knex')({
  client: 'sqlite3',
  connection: {
    filename: "./dev.sqlite3"
  }
});

module.exports = knex;