-- Dijalankan saat sudah terhubung ke database "kuliah_wf_2025"
CREATE TABLE IF NOT EXISTS "user" (
    iduser   BIGSERIAL    PRIMARY KEY,
    nama     VARCHAR(500) NOT NULL,
    email    VARCHAR(200) NOT NULL UNIQUE,
    password VARCHAR(300) NOT NULL
);

CREATE TABLE IF NOT EXISTS role (
    idrole    BIGSERIAL    PRIMARY KEY,
    nama_role VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS user_role (
    iduser BIGINT  NOT NULL REFERENCES "user"(iduser) ON DELETE CASCADE,
    idrole BIGINT  NOT NULL REFERENCES role(idrole),
    status BOOLEAN NOT NULL DEFAULT FALSE,   -- TRUE = role sedang aktif
    PRIMARY KEY (iduser, idrole)
);

INSERT INTO role (nama_role) VALUES ('Admin'), ('Dokter'), ('Paramedis'), ('User');
