-- SQLite
DROP TABLE data;

CREATE TABLE IF NOT EXISTS data (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    tank_level REAL NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);