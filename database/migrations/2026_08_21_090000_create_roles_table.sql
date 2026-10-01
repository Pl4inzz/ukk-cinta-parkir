-- create_roles_table
-- Daftar role bawaan aplikasi.

CREATE TABLE IF NOT EXISTS `roles` (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(50) NOT NULL UNIQUE,
    created_at    DATETIME NULL,
    updated_at    DATETIME NULL,
    can_register  TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Role bawaan aplikasi
INSERT INTO `roles`
(`name`, `created_at`, `updated_at`, `can_register`)
VALUES
('owner', NOW(), NOW(), 0),
('admin', NOW(), NOW(), 0),
('petugas', NOW(), NOW(), 0);