# Livewire Spotlight Search

This package allows you to build a Livewire spotlight search.

## Installation

You can install the package via composer:

```bash
composer require tnt-freskim-veliu/livewire-spotlight-search
```

## Requirements

This package uses `livewire/livewire` (https://laravel-livewire.com/) under the hood.

It also uses TailwindCSS (https://tailwindcss.com/) for base styling, and Alpine JS (https://alpinejs.dev/) for reactivity.

Please make sure you include all of them dependencies before using this component.

## Usage

In order to use this component, first you have to include script directive:
`@livewireSpotlightSearchScript`

and then you can put the component: `<livewire:spotlight-search />`

after you have to publish config file:
``` bash
php artisan vendor:publish --tag=livewire-spotlight-search-config
```
in the config you have to fill searchable key with classes that implements ``Searchable`` contract.

Example you can declare the UserSearch class that will handle the search.
``` php
return [
    'searchable' => 'App\SpotlightSearch\UserSearch'
];
```

Each class must include these methods like in example:

``` php
class UserSearch implements Searchable
{
    public function search(string $query): array
    {
        return User::query()
               ->where('name', 'LIKE', "%$query%")
               ->take(25)
               ->get()
               ->toArray();
    }
    
    public function group()
    {
        return "Users";
    }
    
    public function onSelect($id, Component $component)
    {
        //handle logic when the item is clicked
    }
}
```

The search modal can be open in many ways: 
``Cmd+k``
``Cmd+/`` or by dispatching a browser event with name `open-spotlight`.

Please don't forget to change `tailwind.config.js` content part, by adding:
`./vendor/tnt-freskim-veliu/resources/views/*.blade.php`, so tailwind will recognise the classes that we use.

Currently we support the dark mode and light mode by passing:
`:on-dark-mode="bool""`

## TODO
Add command that will create spotlight search classes

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email freskim.veliu@gmail.com instead of using the issue tracker.

## Credits

- [Freskim Veliu](https://github.com/tnt-freskim-veliu)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
