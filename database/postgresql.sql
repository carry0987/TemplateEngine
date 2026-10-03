CREATE TABLE IF NOT EXISTS template (
    tpl_id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    tpl_path VARCHAR(500) NOT NULL,
    tpl_name VARCHAR(100) NOT NULL,
    tpl_type VARCHAR(4) NOT NULL,
    tpl_hash VARCHAR(80) NOT NULL,
    tpl_expire_time BIGINT NOT NULL,
    tpl_verhash VARCHAR(20) NOT NULL,
    CONSTRAINT template_version_key UNIQUE (tpl_path, tpl_name, tpl_type)
);
