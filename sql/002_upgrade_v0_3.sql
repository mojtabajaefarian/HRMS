USE `samfonir_HRMS`;

CREATE TABLE IF NOT EXISTS categories (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS teams (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS positions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE personnel
  ADD COLUMN IF NOT EXISTS national_code VARCHAR(20) NULL AFTER full_name,
  ADD COLUMN IF NOT EXISTS mobile VARCHAR(20) NULL AFTER national_code,
  ADD COLUMN IF NOT EXISTS category_id INT UNSIGNED NULL AFTER mobile,
  ADD COLUMN IF NOT EXISTS team_id INT UNSIGNED NULL AFTER category_id,
  ADD COLUMN IF NOT EXISTS notes TEXT NULL AFTER last_updated_at;

INSERT INTO categories (name) SELECT * FROM (SELECT 'اداری') x WHERE NOT EXISTS (SELECT 1 FROM categories WHERE name='اداری');
INSERT INTO categories (name) SELECT * FROM (SELECT 'فروش') x WHERE NOT EXISTS (SELECT 1 FROM categories WHERE name='فروش');
INSERT INTO categories (name) SELECT * FROM (SELECT 'فنی') x WHERE NOT EXISTS (SELECT 1 FROM categories WHERE name='فنی');

INSERT INTO teams (name) SELECT * FROM (SELECT 'تیم مرکزی') x WHERE NOT EXISTS (SELECT 1 FROM teams WHERE name='تیم مرکزی');
INSERT INTO teams (name) SELECT * FROM (SELECT 'تیم فروش') x WHERE NOT EXISTS (SELECT 1 FROM teams WHERE name='تیم فروش');
INSERT INTO teams (name) SELECT * FROM (SELECT 'تیم پشتیبانی') x WHERE NOT EXISTS (SELECT 1 FROM teams WHERE name='تیم پشتیبانی');

INSERT INTO positions (name) SELECT * FROM (SELECT 'کارشناس فروش') x WHERE NOT EXISTS (SELECT 1 FROM positions WHERE name='کارشناس فروش');
INSERT INTO positions (name) SELECT * FROM (SELECT 'پشتیبان') x WHERE NOT EXISTS (SELECT 1 FROM positions WHERE name='پشتیبان');
INSERT INTO positions (name) SELECT * FROM (SELECT 'ادمین') x WHERE NOT EXISTS (SELECT 1 FROM positions WHERE name='ادمین');
