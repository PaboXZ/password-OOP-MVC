CREATE TABLE IF NOT EXISTS users(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    login varchar(255) NOT NULL UNIQUE,
    email varchar(255) NOT NULL UNIQUE,
    password_hash varchar(255) NOT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS passwords(
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    password_name varchar(255) NOT NULL,
    password_hash varchar(255) NOT NULL,
    user_id bigint(20) unsigned NOT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users
);