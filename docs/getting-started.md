---
sidebar_position: 2
---

# Getting Started

## Requirements

- PHP 8.1 or later.
- Composer.
- Write access to the configured cache directory.
- Optional: `pdo_pgsql` for PostgreSQL, `pdo_mysql` for MySQL, or the PHP Redis extension for Redis-backed metadata.

## Install

```bash
composer require carry0987/template-engine
```

## Configure and render

```php
<?php

require __DIR__.'/vendor/autoload.php';

use carry0987\Template\Template;

$template = new Template([
    'template_dir' => __DIR__.'/template',
    'cache_dir' => __DIR__.'/cache',
    'css_dir' => __DIR__.'/static/css',
    'js_dir' => __DIR__.'/static/js',
    'static_dir' => __DIR__.'/static',
    'auto_update' => true,
    'cache_lifetime' => 0,
]);

$name = 'Ada';
include $template->loadTemplate('home.html');
```

Create `template/home.html`:

```html
<h1>Hello {$name}</h1>
```

The compiled PHP file is written to `cache/`. With `auto_update` enabled, a source file is recompiled when its content hash changes.

## Configuration options

| Option | Default | Purpose |
| --- | --- | --- |
| `template_dir` | `templates/` | Source HTML templates. |
| `cache_dir` | `templates/cache/` | Compiled template cache. |
| `css_dir` | `css/` | Source CSS directory, or `false` to disable CSS handling. |
| `js_dir` | `js/` | Source JavaScript directory, or `false` to disable JavaScript handling. |
| `static_dir` | `static/` | Static asset directory, or `false` to disable static helper paths. |
| `css_cache_dir` | `null` | Optional cache directory that overrides `cache_dir` for CSS. |
| `js_cache_dir` | `null` | Optional cache directory that overrides `cache_dir` for JavaScript. |
| `auto_update` | `false` | Recompile when a source hash changes. |
| `cache_lifetime` | `0` | Cache lifetime in minutes; `0` means no time-based expiry. |

Use `compressHTML(true)` or `compressCSS(true)` to enable the corresponding minifier. Use `assetPath()` to transform generated asset paths, for example when serving assets from a CDN.
