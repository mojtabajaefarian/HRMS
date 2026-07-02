USE `samfonir_HRMS`;

CREATE TABLE IF NOT EXISTS personnel_deficiencies (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  personnel_id INT UNSIGNED NOT NULL,
  deficiency_title VARCHAR(255) NOT NULL,
  deficiency_description TEXT NULL,
  deficiency_status VARCHAR(50) NOT NULL DEFAULT 'باز',
  due_at DATETIME NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_pd_personnel (personnel_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS personnel_followups (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  personnel_id INT UNSIGNED NOT NULL,
  followup_text TEXT NOT NULL,
  followup_status VARCHAR(50) NOT NULL DEFAULT 'باز',
  followup_at DATETIME NOT NULL,
  result_text TEXT NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_pf_personnel (personnel_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS personnel_actions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  personnel_id INT UNSIGNED NOT NULL,
  action_title VARCHAR(255) NOT NULL,
  action_description TEXT NULL,
  action_status VARCHAR(50) NOT NULL DEFAULT 'باز',
  action_at DATETIME NOT NULL,
  result_text TEXT NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_pa_personnel (personnel_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS personnel_positions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  personnel_id INT UNSIGNED NOT NULL,
  position_id INT UNSIGNED NOT NULL,
  INDEX idx_pp_personnel (personnel_id),
  INDEX idx_pp_position (position_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
