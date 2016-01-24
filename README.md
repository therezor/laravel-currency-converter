# Laravel Currency Converter
Currency converter widget for laravel 5

## Installation

1) Run ```composer require therezor/laravel-currency-converter-widget``` in your laravel project root folder

2) Register a service provider in the `app.php` configuration file

```php
<?php

'providers' => [
    ...
    Arrilot\Widgets\ServiceProvider::class,
    TheRezor\CurrencyWidget\ServiceProvider::class,
],
?>
```

3) Add some facades here too. 

```php
<?php

'aliases' => [
    ...
    'Widget'       => Arrilot\Widgets\Facade::class,
    'AsyncWidget'  => Arrilot\Widgets\AsyncFacade::class,
],
?>
```

4) Run ```php artisan vendor:publish```

5) Add into view where you want to be the widget ```@widget('CurrencyConverter')```
