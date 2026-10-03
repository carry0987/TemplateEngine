---
sidebar_position: 3
---

# Template Syntax

TemplateEngine compiles its tags to PHP. Use HTML comments for control tags so the source remains valid HTML.

## Variables and expressions

```html
<h1>{$title}</h1>
<p>{echo strtoupper($title)}</p>
<!--{eval $total = $price * $quantity}-->
<span>{$total}</span>
```

`{$variable}` is shorthand for PHP output. `{echo ...}` outputs an arbitrary PHP expression. `{eval ...}` evaluates PHP code, so it should only appear in trusted template files.

## Conditions

```html
<!--{if $isLoggedIn}-->
  <p>Welcome back.</p>
<!--{elseif $isGuest}-->
  <p>Please sign in.</p>
<!--{else}-->
  <p>Account status is unavailable.</p>
<!--{/if}-->
```

## Loops

```html
<!--{loop $products $product}-->
  <li>{$product}</li>
<!--{/loop}-->
```

Use a key and value when needed:

```html
<!--{loop $products $sku $product}-->
  <li data-sku="{$sku}">{$product}</li>
<!--{/loop}-->
```

## Includes

```html
<!--{template partials/header.html}-->
```

Template names are static. The include compiles and loads the named template from `template_dir`.

## Blocks

Blocks capture rendered markup into a PHP variable:

```html
<!--{block notice}-->
<p class="notice">Saved.</p>
<!--{/block}-->

<aside>{$notice}</aside>
```

Do not put PHP control tags inside a block; the captured content is intended to be markup.

## Preserve regions

Content wrapped in a preserve region is restored after template processing. This is useful for literal examples or client-side templating syntax that would otherwise look like TemplateEngine tags.

```html
<!--{PRESERVE}-->
<script>const value = '${notTemplateEngine}';</script>
<!--{/PRESERVE}-->
```

CSS-style preserve markers are also supported:

```css
/*{PRESERVE}*/
/* literal content */
/*{/PRESERVE}*/
```
