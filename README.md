# Backpack-profile

[![Build Status](https://travis-ci.org/parabellumKoval/backpack-transactions.svg?branch=master)](https://travis-ci.org/parabellumKoval/backpack-transactions)
[![Coverage Status](https://coveralls.io/repos/github/parabellumKoval/backpack-transactions/badge.svg?branch=master)](https://coveralls.io/github/parabellumKoval/backpack-transactions?branch=master)

[![Packagist](https://img.shields.io/packagist/v/parabellumKoval/backpack-transactions.svg)](https://packagist.org/packages/parabellumKoval/backpack-transactions)
[![Packagist](https://poser.pugx.org/parabellumKoval/backpack-transactions/d/total.svg)](https://packagist.org/packages/parabellumKoval/backpack-transactions)
[![Packagist](https://img.shields.io/packagist/l/parabellumKoval/backpack-transactions.svg)](https://packagist.org/packages/parabellumKoval/backpack-transactions)

This package provides a quick starter kit for implementing a transactions system for Laravel Backpack. Provides a database, CRUD interface, API routes and more.

## Installation

Install via composer
```bash
composer require parabellumkoval/backpack-transactions
```

Migrate
```bash
php artisan migrate
```

### Publish

#### Configuration File
```bash
php artisan vendor:publish --provider="Backpack\Transactions\ServiceProvider" --tag="config"
```

#### Views File
```bash
php artisan vendor:publish --provider="Backpack\Transactions\ServiceProvider" --tag="views"
```

#### Migrations File
```bash
php artisan vendor:publish --provider="Backpack\Transactions\ServiceProvider" --tag="migrations"
```

#### Routes File
```bash
php artisan vendor:publish --provider="Backpack\Transactions\ServiceProvider" --tag="routes"
```

## Usage

### Seeders
```bash
php artisan db:seed --class="Backpack\Transactions\database\seeders\TransactionsSeeder"
```

## Security

If you discover any security related issues, please email 
instead of using the issue tracker.

## Credits

- [](https://github.com/parabellumKoval/backpack-transactions)
- [All contributors](https://github.com/parabellumKoval/backpack-transactions/graphs/contributors)
