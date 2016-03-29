# Voat PHP 
---
#### A PHP wrapper around the Voat API
[![Latest Version](https://img.shields.io/github/release/devsi/voat-php.svg?style=flat-square)](https://github.com/devsi/voat-php/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://travis-ci.org/devsi/voat-php.svg?branch=develop)](https://travis-ci.org/devsi/voat-php) 


Voat PHP is a small library which allows you to access [Voat][voat] (the media aggregator) through simple, easy to use accessor methods.  
Note that this currently only supports the legacy voat API. Keep an eye out for changes though as support for the new API is not far away!

#### Version
0.1.0 (pre alpha) (unreleased)

#### Installation

You need composer installed globally:  
(A packagist installation is on its way.)

```sh
$ git clone [git-repo-url] voatphp
$ cd voatphp
$ composer install
```

#### Usage

Using Voat PHP is simple:

To create a new instance of the PHP Voat API
```php
$voatphp = new \Devsi\PhpVoat\PhpVoat();
```
To start providing subverse data
```php
$subverseProvider = $voatphp->subverse();
```
...and user data
```php
$userProvider = $voatphp->user();
```
...and submission data (Voat's legacy submission API is currently giving a 500 error)
```php
$submissionProvider = $voatphp->submission();
```
...comment data.
```php
$commentProvider = $voatphp->comment();
```
And now to retrieve a list of subverses.
```php
$subverses = $voatphp->subverse()->getTop200Subverses();
```

Other methods are also available within each provider. Take a peek in [./src/Provider/][providers] for a full list.

#### License
----

The MIT License (MIT). Please see [License File][license] for more information.


[voat]: <https://voat.co/>
[license]: <https://github.com/devsi/voat-php/blob/develop/LICENSE>
[providers]: <https://github.com/devsi/voat-php/tree/develop/src/Provider>
