[![Build Status](https://travis-ci.org/mnshankar/flashmessenger.png)](https://travis-ci.org/mnshankar/flashmessenger)

# Easy Flash Messages

## Installation

First, pull in the package through Composer.

```js
"require": {
    "mnshankar/flashmessenger": "1.0"
}
```

And then, if using Laravel, include the service provider within `app/config/app.php`.

```php
'providers' => array(
    'mnshankar\Flash\FlashServiceProvider'
);
```

And, for convenience, add a facade alias to this same file at the bottom:

```php
'aliases' => array(
    'Flash' => 'mnshankar\Flash\Flash'
);
```

## Usage

Within your controllers, before you perform a redirect...

```php
public function store()
{
    Flash::message('Welcome Aboard!');

    return Redirect::home();
}
```

You may also do:

- 'Flash::info('Message')`
- `Flash::success('Message')`
- `Flash::error('Message')`
- `Flash::warning('Message')`
- `Flash::overlay('Modal Message', 'Modal Title')`

Again, if using Laravel, this will set three keys in the session:

- 'flash_notification.message' - The message you're flashing
- 'flash_notification.level' - A string that represents the type of notification (good for applying HTML class names)

With this message flashed to the session, you may now display it in your view(s). Maybe something like:

```html
@if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('flash_notification.message') }}
    </div>
@endif
```

> Note that this package is optimized for use with Twitter Bootstrap.

Because flash messages and overlays are so common, if you want, you may use (or modify) the views that are included with this package. Simply append to your layout view:

```html
@include('flashmessenger::message')
```

## Example

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    @include('flashmessenger::message')

    <p>Welcome to my website...</p>
</div>

<script src="//code.jquery.com/jquery.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- This is only necessary if you do Flash::overlay('...') -->
<script>
    $('#flash-overlay-modal').modal();
</script>

</body>
</html>
```

If you need to modify the flash message partials, you can run:

```bash
php artisan view:publish mnshankar/flashmessenger
```

The two package views will now be located in the `app/views/packages/mnshankar/flashmessenger/' directory.
