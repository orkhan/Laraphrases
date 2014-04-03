# Laraphrases! 

![Laraphrases](http://www.origami-agency.com/keep-calm-and-use-laraphrases-git.png)

Laraphrases is a package for live editing phrases on websites.

## Installation

Require the package in your composer.json file

```json
{
    "require": {
        "orkhan/laraphrases": "dev-master"
    },
}
```

Afterwards, run `composer update` from your command line.

Then, add following to the list of service providers in `app/config/app.php`

```php
'Orkhan\Laraphrases\LaraphrasesServiceProvider',
```

and followings to the list of aliases

```php
'Laraphrases' => 'Orkhan\Laraphrases\Facades\Laraphrase',
'Phrase' => 'Orkhan\Laraphrases\Facades\Phrase',
```

Run the install command which will migrate database and publishes configs, views and assets.

```bash
artisan laraphrases:install
```

## Setup

The artisan command will generate <tt>phrase.php</tt> configuration file in <tt>app/config/packages/orkhan/laraphrases</tt> folder. Here you will need to implement the <tt>can_edit</tt> filter. Use this to hook-up your existing user authentication system to work with Laraphrases.

For example:

```php
    'can_edit' => function() {
        return Sentry::check() && Sentry::getUser()->hasAccess('laraphrases') ? true : false
    },
```
Include the token meta at the head of your application layout file.

    <meta name="_token" content="{{ Session::token() }}">

Include the laraphrase **blade** file at the top of your application layout file.

    @if(Laraphrase::canEditPhrase())
        @include('laraphrases::laraphrase')
    @endif

Include the required jQuery library and Laraphrases **javascript** file:

    {{ Laraphrase::js() }}

Include the required **stylesheet** file:

    {{ Laraphrase::css() }}

## How to use Laraphrases?

You can start adding new phrases by simply adding them in your view file:

	{{ Laraphrase::get('phrase-key', 'phrase-value-optional-otherwise-value-same-with-key') }}

Aside from editing phrases (basically, Laravel translations) you can also edit model attributes inline. Use the same `Laraphrase::get` method, with the first attribute being the record in question, and the second one the attribute you wish to make editable:

  	{{ Laraphrase::get($post, 'title') }}

In the above example, <tt>$post</tt> is the record with a <tt>title</tt> attribute.

## Security

Since Laraphrases can be used to update any attribute in any table, special care must be taken into consideration from a security standpoint.

By default, Laraphrases doesn't allow updating of any attribute apart from <tt>'Phrase' => ['value']</tt>. To be able to work with other attributes, you need to whitelist them.

In the <tt>app/config/packages/orkhan/laraphrases/phrase.php</tt> file you can whitelist your model attributes like this:

```php
    'white_list' => [
        'Phrase' => ['value'],
        'Post' => ['title', 'summary'],
    ],
```

## Credits

Laraphrases is maintained and sponsored by
[ORIGAMI AGENCY](http://www.origami-agency.com).

![ORIGAMI AGENCY](http://www.origami-agency.com/logo.png)

Laraphrases leverages part [ZenPen](https://github.com/tholman/zenpen/tree/master/).

## License

Laraphrases © 2014 ORIGAMI AGENCY. It is free software, and may be redistributed under the terms specified in the LICENSE file.