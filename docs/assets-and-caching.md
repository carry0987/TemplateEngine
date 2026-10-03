---
sidebar_position: 4
---

# Assets and Caching

TemplateEngine generates cache-aware URLs for CSS and JavaScript and can create paths for static files.

## CSS

Reference a CSS file directly:

```html
<link href="{loadcss common.css}" rel="stylesheet">
```

For CSS modules, supply a fixed module name or a PHP variable as the second argument:

```html
<link href="{loadcss model.css dashboard}" rel="stylesheet">
<link href="{loadcss model.css $sections}" rel="stylesheet">
```

Declare a module in the CSS source:

```css
/*[dashboard]*/
.dashboard { display: grid; }
/*[/dashboard]*/
```

`$sections` may be a comma-separated string or an array. TemplateEngine writes a generated CSS cache file and appends a version query parameter to the URL.

## JavaScript

```html
<script src="{loadjs app.js}"></script>
```

JavaScript paths receive the same cache-busting version query parameter strategy.

## Static files

For a fixed path:

```html
<img src="{static img/logo.png}" alt="Logo">
```

Static, CSS, and JavaScript file names are fixed tag arguments. To create a path from a PHP variable, call the Asset API in an expression:

```html
<img src="{echo TPL::getAsset()->loadStaticFile('img/'.$name.'.jpg')}" alt="Profile image">
```

## Transforming generated paths

Use `assetPath()` to transform generated asset paths before output. This is useful for adding a public prefix or CDN host.

```php
$template->assetPath(function (string $path, string $type): string {
    return 'https://cdn.example.test/'.$path;
});
```

The callback receives the generated path and one of `css`, `js`, or `static`.
