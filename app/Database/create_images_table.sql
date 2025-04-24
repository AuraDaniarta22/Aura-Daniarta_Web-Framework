CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image LONGBLOB NOT NULL, -- Untuk menyimpan data gambar dalam format binary
    description TEXT,        -- Untuk menyimpan deskripsi gambar
    category VARCHAR(255),   -- Untuk menyimpan kategori gambar
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);