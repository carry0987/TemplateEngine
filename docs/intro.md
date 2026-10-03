---
sidebar_position: 1
---

# TemplateEngine

TemplateEngine is a PHP library for compiling HTML templates and managing cache-aware CSS, JavaScript, and static assets. It supports local file metadata by default and can persist cache metadata through Redis, PostgreSQL, or MySQL.

## What it does

- Compiles templates into PHP cache files.
- Renders variables, includes, conditionals, loops, blocks, and evaluated expressions.
- Generates versioned CSS and JavaScript paths.
- Supports CSS modules selected by a string or array of names.
- Tracks template and asset versions in local files, Redis, or a relational database.

## How it works

Create a `Template` instance, configure its source and cache directories, then include the compiled result of `loadTemplate()`:

```php
use carry0987\Template\Template;

$template = new Template([
    'template_dir' => __DIR__.'/template',
    'cache_dir' => __DIR__.'/cache',
    'css_dir' => __DIR__.'/static/css',
    'js_dir' => __DIR__.'/static/js',
    'static_dir' => __DIR__.'/static',
    'auto_update' => true,
]);

$title = 'Hello';
include $template->loadTemplate('page.html');
```

Template files are trusted source code. Tags such as `{echo ...}`, `{eval ...}`, conditions, and loops compile to PHP, so do not allow untrusted users to edit template files.

## Documentation map

- [Getting Started](./getting-started.md) installs and configures the library.
- [Template Syntax](./template-syntax.md) documents every built-in template tag.
- [Assets and Caching](./assets-and-caching.md) covers CSS, JavaScript, and static assets.
- [Cache Backends](./cache-backends.md) configures file, Redis, PostgreSQL, and MySQL metadata storage.
- [Local Development](./local-development.md) explains the optional Docker Compose environment.

