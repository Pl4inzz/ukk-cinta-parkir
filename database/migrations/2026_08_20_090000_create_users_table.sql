-- create_users_table
-- Tabel user dengan kolom role untuk login multi-role (admin/staff/user).

CREATE TABLE IF NOT EXISTS `users` (
    id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username       VARCHAR(255) NOT NULL,
    nama_lengkap   VARCHAR(100) NULL,
    password       VARCHAR(255) NOT NULL,
    role           VARCHAR(50)  NOT NULL DEFAULT 'user',
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Satu-satunya akun bawaan: admin, password rahasia123
-- (hash dibuat dengan password_hash(), lihat /docs untuk penjelasan)
-- Role lain (staff, user, dst) dibuat sendiri oleh admin lewat /admin/roles
-- dan /admin/users setelah instalasi pertama.
INSERT INTO `users`
(`id`, `username`, `nama_lengkap`, `password`, `role`, `created_at`, `updated_at`)
VALUES
(1, 'owner', 'Demo Owner', '$2y$12$ntn3LANEH6afERNoQs6vueMqxger3kP.hWMsMZDR9E.EnOsWC2xy6', 'owner', NOW(), NOW()),
(2, 'admin', 'Demo Admin', '$2y$12$ntn3LANEH6afERNoQs6vueMqxger3kP.hWMsMZDR9E.EnOsWC2xy6', 'admin', NOW(), NOW()),
(3, 'petugas', 'Demo Petugas', '$2y$12$ntn3LANEH6afERNoQs6vueMqxger3kP.hWMsMZDR9E.EnOsWC2xy6', 'petugas', NOW(), NOW());
