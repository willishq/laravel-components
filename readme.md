# Laravel components

These are components which I use frequently when creating and maintaining a Laravel project, and two traits which I keep
copying from project to project.

## Installation

Grab this package through Composer:

```js
{
    "require" {
        "willishq/laravel-components": "1.*"
    }
}
```



## Traits

The two traits provided are the `EventableTrait` and the `RetrievableTrait`.

### EventableTrait Usage

The `EventableTrait` is used in tandem with `laracasts\commander` package and enables you to raise and dispatch events
directly on your objects (such as Eloquent models), along with firing events when the object is destroyed.

`MyModel.php`
```php
use Willishq\LaravelComponents\EventableTrait;
use Illuminate\Database\Eloquent\Model;

class MyModel extends Model {
    use EventableTrait;
    /**
     * Whether to dispatch remaining events when the object is tore down
     *
     * @var bool
     */
    protected $dispatchOnDestruct = true;
}
```

```php
$model = new MyModel;

$model->raise(new ModelWasInstantiatedEvent($model));
```

if you left the model like this, the event would be fired automatically by the `__destruct` method, or you can call
`$model->dispatchEvents();` which would dispatch all remaining events.

### RetrievableTrait Usage

The `RetrievableTrait` enables you to retrieve specific `public` keys from your objects. It provides you with two methods,
`retrieveOnly` and `retrieveExcept`

```php
use Willishq\LaravelComponents\RetrievableTrait;
class Book {
    use RetrievableTrait;

    public $title;
    public $author;
    public $publish_date;
    public $blurb;

    public function __construct($title, $author, $publish_date, $blurb)
    {
        $this->title = $title;
        $this->author = $author;
        $this->publish_date = $publish_date;
        $this->blurb = $blurb;
    }
}
```

```php
$book = new Book('My Amazing Book', 'Andrew Willis', '19/04/2020', 'Andrew was a normal person from Sunderland. you\'ll never believe what happened next.');

$fields = $book->retrieveOnly('title', 'author');
// ['title' => 'My Amazing Book', 'author' => 'Andrew Willis']

$fields = $book->retrieveExcept('blurb');
// ['title' => 'My Amazing Book', 'author' => 'Andrew Willis', '19/04/2020']

```

I have found this useful when dealing with DTO's.

## Packages

Please be sure to add the following to your `config/app.php` file to use the packages!

### Service Providers:

```php
        // Laravel DebugBar
        'Barryvdh\Debugbar\ServiceProvider',
        // Laracasts Commander package
        'Laracasts\Commander\CommanderServiceProvider',
        // Laracasts Flash package
        'Laracasts\Flash\FlashServiceProvider',
        // Laravel 5 requires you to include the HTML package yourself
        'Illuminate\Html\HtmlServiceProvider',
```

### Facades:

```php
        'Debugbar'  => 'Barryvdh\Debugbar\Facade',
        'Form'      => 'Illuminate\Html\FormFacade',
        'Flash'     => 'Laracasts\Flash\Flash'
```

Other packages included are: `laracasts/presenter` and `league/fractal`.

Documentation for all of the packages included can be found here:

- [fractal.thephpleague.com](http://fractal.thephpleague.com)
- [github.com/laracasts/Presenter](https://github.com/laracasts/Presenter)
- [github.com/laracasts/flash](https://github.com/laracasts/flash)
- [github.com/laracasts/commander](https://github.com/laracasts/Commander)
- [github.com/barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)

For development and testing, I suggest you use `codeception/codeception`, `laracasts/testdummy` and `fzaninotto/faker`
- [github.com/laracasts/Presenter](https://github.com/laracasts/TestDummy)
- [github.com/fzaninotto/faker](https://github.com/fzaninotto/faker)
- [github.com/codeception/codeception](https://github.com/codeception/codeception)
