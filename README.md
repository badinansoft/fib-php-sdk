
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

```
| Parameter|  Description|
|--|------|
| **Client_id**  |  Client id provided by FIB|
| **client_secret** |  Client Secret provided by FIB |

       
   


```php

//create a payment
$payment = $fib->payments()
    ->createPayment(amount: 20,
				    currency: 'IQD',
				    description: 'Host Invoice #2832',
				    statusCallbackUrl: 'https://.....')
				    
```

| Parameter|  Description|
|--|------|
| **amount**  |  the amount of the payment |
| **currency**  |  the currency of the payment; currently only IQD is supported |
| **description**| (Optional) Description of the payment to help your customer to identify it in the FIB app, with the maximum length of 50 characters.|
|**statusCallbackUrl**|  should be able to handle POST requests with request body that contains two properties: - **id:** this will be the payment id <br> - **status:** this will be the status of the payment, for more information, go to Check Status endpoint section of this |

```php
	//return all data as stdClass Object 
	$payment->getData();
```
##### Expected Response
| Property | Description  |
|--|--|
| **paymentId** | A unique identifier of the payment, used later to check the status. |
|**qrCode**|A base64-encoded data URL of the QR code image that the user can scan with the FIB mobile app.|
|**readableCode**|A payment code that the user can enter manually in case he cannot scan the QR code.|
|**personalAppLink**|A link that the user can tap on his mobile phone to go to the corresponding payment screen in the FIB Personal app.|
|**businessAppLink**|A link that the user can tap on his mobile phone to go to the corresponding payment screen in the FIB Business app|
|**corporateAppLink**|A link that the user can tap on his mobile phone to go to the corresponding payment screen in the FIB Corporate app|
|**validUntil**|An ISO-8601-formatted date-time string, representing a moment in time when the payment expires|




```php
//Check payment status
$fib->payments()
    ->paymentStatus(paymentId: '9dfa724f-4784-4487-811b-63057b540503')
	->getData();
```
##### Expected Response
| Property | Description  |
|--|--|
|**paymentId**|a unique identifier of the payment.|
|**status**|Expected values are PAID | UNPAID | DECLINED|
|**validUntil**|an ISO-8601-formatted date-time string, representing a moment in time when the payment expires|
|**paidAt**|an ISO-8601-formatted date-time string, representing a moment in time when the payment is done.|
|**amount**|a JSON object, containing two key-value pairs; the _amount_ and _currency_ of the payment.|
|**decliningReason**|Expected Values are: <br>-SERVER_FAILURE: Payment failure due to some internal error.<br>-PAYMENT_EXPIRATION: Payment has expired.<br>-PAYMENT_CANCELLATION: Payment canceled by the user.|
|||


```php
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
