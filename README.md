# Modal user choice dialogue for laravel

If you have an action that needs to be confirmed before proceeding,
or you want to let the user choose from multiple options, 
then this solution might just be exactly what you are looking for.

## Example

The user has chosen to delete a person. That means that all upcoming events, 
hosted by this person, need to be canceled. But you don't want to cancel them
silently. You want to be polite and ask the user first:

[Screenshot of a modal choice dialogue implemented with macrominds/laravel-choice](http://www.macrominds.de/images/github/macrominds-laravel-choice.png)

Simply return the Choice where you would normally return the `redirect()` in your Controller.
  
```
return Choice::make(
    'Deleting the person will cancel some events',
    sprintf(
        '%s events are going to be canceled if you delete %s',
        $numEvents, $personName
    ),
    [
        Option::makeCancel('Cancel deletion'),
        Option::make(
            'Delete person and cancel events',
            route('customer.force-destroy', ['person' => $person]),
            'DELETE',
            [],
            true),
    ]
);
```

Depending on the choice of the user, she will be redirected either 
back to the previous page (standard `Option::makeCancel` behaviour) or 
to any route of your liking. You are **not limited** to two options. 

## Installation

`composer require macrominds/laravel-choice`.

## Usage

You should call `php artisan vendor:publish --tag=laravel-choice`. 

This will add the customizable views to `resources/views/vendor/choice/*` and the minimalistic 
styling `resources/assets/sass/vendor/choice/_choice.scss` to your project.
You should `@import "vendor/choice/choice";` in your `app.scss` afterwards.

In your master blade view, below all visible page elements, just before the end of your 
`</body>` or just before the `<script>`s at the bottom, add the following line:
 
 ```
 {{ macrominds\laravel\choice\Choice::render() }}
 ```
 
Next? Nothing. You are ready to go. Just replace a `return redirect()` statement 
in your Controller with `return Choice::make (//...`.

## TODO
- Add some documentation
- Make php5.6 compatible
