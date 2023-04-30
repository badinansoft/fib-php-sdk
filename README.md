# FIB (First Iraqi Bank)'s PHP payment SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/badinansoft/fib-php-sdk.svg?style=flat-square)](https://packagist.org/packages/badinansoft/fib-php-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/badinansoft/fib-php-sdk.svg?style=flat-square)](https://packagist.org/packages/badinansoft/fib-php-sdk)
![GitHub Actions](https://github.com/badinansoft/fib-php-sdk/actions/workflows/main.yml/badge.svg)

The PHP SDK for First Iraqi Bank's online payment is a library that allows you to integrate First Iraqi Bank's online payment system into your PHP application. The SDK provides a simple and easy-to-use API that allows you to create, status check, and cancel payments.

## Features
* User Authentication: Verifying the user's identity and credentials and generating an access token for future requests.
* Payment Creation: Generating QR codes and dynamic links to direct the user to the payment screen when creating a payment.
* Payment Status Check: Checking the current status of a payment.
* Payment Cancellation: Canceling an active payment that has not yet been paid.
## Installation

You can install the package via composer:

```bash
composer require badinansoft/fib-php-sdk
```

## Usage

```php
// create object instance of class
$fib = new \Badinansoft\FIB\FIB(client_id: '', client_secret:'');

//create a payment
$fib->payments()
    ->createPayment(amount: 20,currency: 'IQD',description: 'Host Invoice #2832',statusCallbackUrl: 'https://.....')

//Check payment status
$fib->payments()
    ->paymentStatus(paymentId: '9dfa724f-4784-4487-811b-63057b540503')

//Cancel Payment
$fib->payments()
    ->cancelPayment(paymentId: '9dfa724f-4784-4487-811b-63057b540503');
```

### Testing

```bash
composer tests
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email me@shahabzebari.net instead of using the issue tracker.

## Credits

-   [Shahab Zebari](https://github.com/badinansoft)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
