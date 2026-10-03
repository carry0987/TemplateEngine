CREATE TABLE IF NOT EXISTS template (
    tpl_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    tpl_path VARCHAR(500) NOT NULL,
    tpl_name VARCHAR(100) NOT NULL,
    tpl_type VARCHAR(4) NOT NULL,
    tpl_hash VARCHAR(80) NOT NULL,
    tpl_expire_time BIGINT UNSIGNED NOT NULL,
    tpl_verhash VARCHAR(20) NOT NULL,
    PRIMARY KEY (tpl_id),
    CONSTRAINT template_version_key UNIQUE (tpl_path, tpl_name, tpl_type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
