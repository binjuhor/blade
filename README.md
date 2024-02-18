## Blade template standalone

This is a standalone blade template engine for PHP. It is a simple and easy to use template engine that is designed to be used in any PHP project.

## Installation

You can install this package via composer using this command:

```bash
composer require binjuhor/blade
```

## Usage

```php
use Binjuhor\Blade\BladeTemplate;

$template = new BladeTemplate([
    'views' => 'path/to/views/folder',
    'cache' => 'path/to/cache/folder',
    'compileDir' => 'path/to/compiled/folder',
    'url' => 'http://your-app-url.test'
]);

echo $template->render('view', ['data' => 'value']);
```

Read more about the blade template engine [here](https://laravel.com/docs/10.x/blade).

### To compile blade templates

You can use the `compile` method to compile blade templates. For example, if you have a blade template called `home.blade.php` and you want to compile it, you can do so by calling the `compile` method.

```php
$template->compile();
```

### Example

```php
require_once "vendor/autoload.php";

use Binjuhor\Blade\BladeTemplate as Blade;

$compileDir = __DIR__ . '/compiles';
$viewDirectory = __DIR__ . '/resources/views';
$cacheDirectory = __DIR__ . '/cache';

$page = isset($_REQUEST['f']) ? $_REQUEST['f'] : 'index';

$blade = new Blade([
	'view' => $viewDirectory,
	'cache' => $cacheDirectory,
	'compileDir' => $compileDir,
	'url' => 'http://html-generator.test'
]);

echo $blade->render($page);
$blade->compiles();
```

### Sample project directory structure

```
./index.php
./cache
./compiles
./resources
    /assets
        /css
        /js
        /images
    /views
        about.blade.php
        contact.blade.php
        home.blade.php
        404.blade.php
        /partials
            header.blade.php
            footer.blade.php
            sidebar.blade.php

```

Check out the [example](https://github.com/binjuhor/html-generator) directory for a complete example.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- Blade template engine by Taylor Otwell
- This package is created by [Binjuhor](mailto:kiemhd@outlook.com)
