# App Store Redirect

Have an app that you need to direct your users to? Send them to the correct app store with this handy class. Requires PHP 7+.

## Install
Via composer:
```bash
composer require mattsparks/appstoreredirect
```

## Example Usage
```php
<?php
require __DIR__ . '/vendor/autoload.php';

use AppStoreRedirect\AppStoreRedirect;

$config = [
    'platforms' => [
        'iOS' => [
            'path' => 'https://itunes.apple.com/us/app/example-app-name/id1234567890',
            'message' => 'Sending you to the Apple App Store',
        ],
        'androidos' => [
            'path' => 'https://play.google.com/store/apps/details?id=com.example.app',
            'message' => 'Sending you to the Google Play Store',            
        ],
    ],
    'delay' => 5,
    'fallback' => [
        'path' => 'http://example.com',
    ],
];

$redirect = new AppStoreRedirect($config);
$redirect->run();
```

## Configuration

| Option   | Values         | Description                                                             |
-----------|----------------|-------------------------------------------------------------------------|
| platform | iOS, androidos | The platform being targeted. A path is required, message is *optional*. |
| deplay   | 0 - ?          | Number of seconds to deplay redirect. *optional*                        |
| fallback | path           | A fallback path should a platform not be matched. *optional*            |

**Note:** Other platforms are likely supported. Under the hood this uses [Mobile Detect](https://github.com/serbanghita/Mobile-Detect) to determine the platform being used. I've only tested iOS and Android so far and can only vouch for those.

## Contribute
Contributions are very welcome!

1. Follow the [PSR-2 Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
2. Create a feature branch.
3. Send a pull request.
