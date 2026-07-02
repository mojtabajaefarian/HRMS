CREATE DATABASE IF NOT EXISTS `samfonir_HRMS` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `samfonir_HRMS`;

DROP TABLE IF EXISTS personnel;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(150) NOT NULL,
  username VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role VARCHAR(50) NOT NULL DEFAULT 'admin',
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE personnel (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  personnel_code VARCHAR(30) NOT NULL UNIQUE,
  row_no INT UNSIGNED NULL,
  full_name VARCHAR(200) NOT NULL,
  file_status ENUM('تکمیل','ناقص') NOT NULL DEFAULT 'ناقص',
  completion_percent TINYINT UNSIGNED NOT NULL DEFAULT 0,
  last_updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (full_name,username,password_hash,role)
VALUES ('Administrator','admin','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','admin');
