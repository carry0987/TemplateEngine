---
sidebar_position: 5
---

# Cache Backends

Local files are the default store for template and asset version metadata. Redis and a relational database are optional alternatives.

## File metadata

No extra configuration is required. Version files are stored alongside the configured cache directory.

## PostgreSQL

Run `database/postgresql.sql` before configuring the controller. PostgreSQL is the recommended relational backend.

```php
use carry0987\Template\Controller\DBController;

$database = new DBController([
    'driver' => 'pgsql',
    'host' => '127.0.0.1',
    'port' => 5432,
    'database' => 'template_engine',
    'username' => 'template_engine',
    'password' => 'secret',
]);

$template->setDatabase($database);
```

## MySQL

Run `database/mysql.sql` first. MySQL 8.0.19 or later is required for the upsert syntax used by TemplateEngine.

```php
$database = new DBController([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'port' => 3306,
    'database' => 'template_engine',
    'username' => 'template_engine',
    'password' => 'secret',
    'charset' => 'utf8mb4',
]);

$template->setDatabase($database);
```

The database schema has a unique key for the template path, name, and type. Version writes use an atomic upsert, avoiding a read-then-write race.

## Redis

```php
use carry0987\Template\Controller\RedisController;

$redis = new RedisController([
    'host' => '127.0.0.1',
    'port' => 6379,
    'password' => 'secret',
    'database' => 5,
]);

$template->setRedis($redis);
```

When both Redis and a database are configured, Redis is checked first. A successful Redis write is used as the version store; the database is used as a fallback when Redis is unavailable.
