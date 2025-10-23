# codemonster-ru/http

[![Latest Version on Packagist](https://img.shields.io/packagist/v/codemonster-ru/http.svg?style=flat-square)](https://packagist.org/packages/codemonster-ru/http)
[![Total Downloads](https://img.shields.io/packagist/dt/codemonster-ru/http.svg?style=flat-square)](https://packagist.org/packages/codemonster-ru/http)
[![License](https://img.shields.io/packagist/l/codemonster-ru/http.svg?style=flat-square)](https://packagist.org/packages/codemonster-ru/http)
[![Tests](https://github.com/codemonster-ru/http/actions/workflows/tests.yml/badge.svg)](https://github.com/codemonster-ru/http/actions/workflows/tests.yml)

Lightweight object-oriented HTTP foundation for PHP.

## 📦 Installation

```bash
composer require codemonster-ru/http
```

## 🚀 Usage

### Handling HTTP Requests

```php
use Codemonster\Http\Request;

// Capture the current request from PHP globals
$request = Request::capture();

echo $request->method();      // GET
echo $request->uri();         // /hello
echo $request->query('id');   // 42
echo $request->input('name'); // Vasya
```

You can also create a request manually (useful for tests or CLI):

```php
$request = new Request(
    'POST',
    '/api/user',
    ['page' => 2],
    ['name' => 'John'],
    ['Accept' => 'application/json']
);

if ($request->wantsJson()) {
    // Return JSON
}
```

### Sending HTTP Responses

```php
use Codemonster\Http\Response;

// Basic response
$response = new Response('Hello world', 200);
$response->send();

// JSON response
return Response::json(['ok' => true])->send();

// Redirect
return Response::redirect('/login');

// Custom headers
$response = (new Response('Created', 201))
    ->header('X-Custom', '1')
    ->type('text/plain')
    ->send();
```

## 🧪 Testing

You can run tests with the command:

```bash
composer test
```

## 👨‍💻 Author

[**Kirill Kolesnikov**](https://github.com/KolesnikovKirill)

## 📜 License

[MIT](https://github.com/codemonster-ru/http/blob/main/LICENSE)
