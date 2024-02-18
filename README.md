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

$template = new BladeTemplate('path/to/views', 'path/to/cache');

echo $template->render('view', ['data' => 'value']);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- Blade template engine by Taylor Otwell
- This package is created by [Binjuhor](mailto:kiemhd@outlook.com)
