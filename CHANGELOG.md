# Changelog

All notable changes to this project will be documented in this file.

## [1.0.0] – 2025-10-23

### Added

-   **`Request`** — lightweight immutable HTTP request object with:

    -   method, URI, query, body, headers, and raw body accessors;
    -   JSON body parsing with `application/json` detection;
    -   full URL composition (`scheme()`, `host()`, `fullUrl()`);
    -   static factory `Request::capture()` to build from PHP globals.

-   **`Response`** — HTTP response class with:
    -   content, status, and headers management;
    -   helper methods: `json()`, `redirect()`, `type()`, and `empty()`;
    -   CLI-safe output via `send()`;
    -   string casting via `__toString()`.
