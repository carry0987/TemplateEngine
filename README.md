# TemplateEngine

[![Packagist Version](https://img.shields.io/packagist/v/carry0987/template-engine?style=flat-square)](https://packagist.org/packages/carry0987/template-engine)

TemplateEngine is a lightweight PHP template engine that compiles trusted HTML templates into cached PHP files. It also generates versioned CSS, JavaScript, and static-asset paths, with optional shared cache metadata through Redis, PostgreSQL, or MySQL.

## Requirements

- PHP 8.1 or later
- Composer
- Write access to the configured cache directory

Redis, PostgreSQL, and MySQL are optional. They require the corresponding PHP extensions: `redis`, `pdo_pgsql`, or `pdo_mysql`.

## Install

```bash
composer require carry0987/template-engine
```

## Quick start

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
]);

$name = 'Ada';
include $template->loadTemplate('home.html');
```

Create `template/home.html`:

```html
<h1>Hello {$name}</h1>
<link href="{loadcss app.css}" rel="stylesheet">
<script src="{loadjs app.js}"></script>
```

The compiled template is written to the configured cache directory. With `auto_update` enabled, TemplateEngine recompiles a template when its source content changes.

## Features

- HTML-first syntax for variables, includes, conditions, loops, blocks, and expressions
- Cache-aware CSS, JavaScript, and static asset paths
- CSS modules selected with strings, arrays, or PHP variables
- Local file metadata by default, with optional Redis, PostgreSQL, and MySQL backends
- Configurable cache lifetime and optional HTML/CSS compression

## Documentation

Read the full documentation for [template syntax](https://carry0987.github.io/TemplateEngine/docs/template-syntax), [asset handling](https://carry0987.github.io/TemplateEngine/docs/assets-and-caching), [cache backends](https://carry0987.github.io/TemplateEngine/docs/cache-backends), and [local development](https://carry0987.github.io/TemplateEngine/docs/local-development).

## License

MIT
