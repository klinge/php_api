const db = require('../services/db');
const config = require('../config');

function getAllPaging(page = 1) {
  const offset = (page - 1) * config.listPerPage;
  const data = db.query(`SELECT * FROM quote LIMIT ?,?`, [offset, config.listPerPage]);
  const meta = {page};

  return {
    data,
    meta
  }
}

function getAll() {
    const data = db.query(`SELECT * FROM quote`,[]);
    const meta = {"num_records" : data.length};

    return {
        data,
        meta
    }
}

function getOne(id = 1) {
    const data = db.query(`SELECT * FROM quote WHERE id = ?`,[id]);
    const meta = {"num_records" : data.length};

    return {
        data,
        meta
    }
}

module.exports = {
  getAllPaging,
  getAll,
  getOne
}