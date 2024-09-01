# Laravel RDump

A simple Laravel package for debugging and tracing remotely on www.rdump.dev 

## Installation

You can install the package via composer:

```bash
composer require rdumpdev/laravel-rdump
```

## Configuration
You need a valid project key from www.rdump.dev
Add this to your .env file:

```bash
RDUMP_PRIVATE_KEY="Your project key here"
```
## Usage
You can pass any data in the second argument, except methods or classes.

Use the following code snippet in your application:

```php
rdump('user_registered', [
    'name' => 'John'
])
```
