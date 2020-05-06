## Extended Flashes
<img src="https://vottuscode.github.io/ExtendedFlashes/additional_fmessage.png">
<br/>

## About
You may be asking, what is this? Glad you asked.

During development of website in the Nette Framework, I found myself limited by the default Flash Messages, `$presenter->flashMessage($message, $type)`
<br>That's why I decided I'll do a little addon for these flashes. It works basically the same, but I can set additional arguments which may come handy.

## Installation
Run `composer require vottuscode/extended-flashes`
<br>Go to your BasePresenter.php and add the `Vottus\Flashes\Traits\Flashes` trait:
```php
<?php declare(strict_types=1);
namespace App\Presenters;

use Nette\Application\UI\Presenter;
use Vottus\Flashes\Traits\Flashes;

class BasePresenter extends Presenter
{

    use Flashes;

    // .. your code

}
```
That's basically everything! But how do you actually use it?

## Usage
It is very easy! Instead of `flashMessage($message, $type)` use: `flash($title, $message, $type, $additional)`

First three variables `$title`, `$message` and `$type` are self-explanatory.<br>
If you don't need to set the title, you can set it to null. Type is by default set to `info`.

Variable `$additional` is for additional info, as mentioned earlier. It is later transformed info a JSON using `Nette\Utils\Json::encode()`.
You may use anything that can be converted into a Json, otherwise an `Nette\Utils\JsonException` is thrown.

## Using it with JavaScript
Say what? You can use this with JS? Yes, and there are two ways to use it.
You can use Nittro or Nette.ajax.js, but I'm gonna show you a solution without any libraries.

Let's set a flash message in our Presenter:
```php
$this->flash("Hello", "This is a nice flash message!", "success", [
    "happy" => true
]);
```

Create a JS file in your public folder, for example flashes.js:
```js
function flash(title, message, type, additional) {
    console.log(title) // Hello
    console.log(message) // This is a nice flash message!
    console.log(type) // success
    console.log(additional.happy); // true
}
```

In your `@layout.latte`, add the script:
```latte
<script src="{$baseUrl}/flashes.js"></script>
```
Then add this below it:
```latte
<script n:inner-foreach="$flashes as $flash">
	{varType Vottus\Flashes\Entities\Flash $flash}
	flash({$flash->title}, {$flash->message}, {$flash->flashType}, JSON.parse({$flash->additional}));
</script>
```
(the {varType} is not necessary, it's there for auto completion in IDEs)
> :warning: Do not ever disable escaping, it will create an XSS vulnerability.

Now the flash messages are handled by the JS method flash(), and it depends on you how you use it!

You can for example use third-party libraries like SweetAlert or toastr.js for nice toast messages or alerts.

<img src="https://vottuscode.github.io/ExtendedFlashes/js_fmessage.png">
<br/>SweetAlert Example

## Examples

Printing announcements:
```latte
<div n:foreach="$flashes as $flash">
    {varType Vottus\Flashes\Entities\Flash $flash}
    {var $additional = json_decode($flash->additional)}
    <div class="flash flash-{$flash->flashType}">
        <span><b>{$additional->date}</b> &ndash; By <b>{$additional->author}</b> | {$flash->title}</span>
        <p>{$flash->message}</p>
    </div>
</div>          
```

Using SweetAlert to flash messages:
```latte
<script n:inner-foreach="$flashes as $flash">
    {varType Vottus\Flashes\Entities\Flash $flash}
    flashSwal({$flash->title}, {$flash->message}, {$flash->flashType}, JSON.parse({$flash->additional}));
</script>
```
```js
function flashSwal(title, message, type, additional) {
    Swal.fire({
        title: title,
        text: message,
        position: additional.position,
    });
}
```
<br>

> If you want help, feel free to write me a [mail](mailto:vottus@vott.us) or open an issue.

