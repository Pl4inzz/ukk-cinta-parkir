-- create_members_table

CREATE TABLE IF NOT EXISTS `member` (
    id_member          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_user            INT UNSIGNED NOT NULL,
    kode_member        VARCHAR(50) NOT NULL UNIQUE,
    nama               VARCHAR(255) NOT NULL,
    plat_nomor         VARCHAR(15) NOT NULL,
    jenis_kendaraan    ENUM('motor', 'mobil', 'lainnya') NOT NULL DEFAULT 'motor',
    no_hp              VARCHAR(20) NOT NULL,
    status_aktif       ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif',
    tanggal_kadaluarsa DATE NOT NULL,
    created_at         DATETIME NULL,
    updated_at         DATETIME NULL,
    CONSTRAINT fk_member_user FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;