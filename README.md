# Incoming Curl

[![Latest Version](https://img.shields.io/github/release/thephpleague/skeleton.svg?style=flat-square)](https://github.com/osadchyi-s/incoming-curl/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/league/skeleton.svg?style=flat-square)](https://packagist.org/packages/osadchyi-s/incoming-curl)

This package for creating curl command line from incoming request data.

## Install

Via Composer

``` bash
$ composer require osadchyi-s/incoming-curl
```

## Usage

Make current incoming curl from global data
``` php
$curlLine = IncomingCurl::makeCurlFromGlobals();
```

Make curl from custom data
``` php
$IC = new IncomingCurl();
$IC->setUrl('http://example');
$IC->setBody(json_encode(['test'=>1]));
$IC->setHeaders([
    [
        'Content-Type'=> ['appliation/json']
    ]
]);
$IC->setMethod('GET');

$curlLine = $IC->makeCurlCommandLine();
```

## Credits

- [Osadchyi Serhii](https://github.com/osadchyi-s)
- [All Contributors](https://github.com/osadchyi-s/incoming-curl/contributors)

## License

The GPL3 License. Please see [License File](LICENSE.md) for more information.
