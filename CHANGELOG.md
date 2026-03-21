# Changelog

All notable changes to `laravel-index-now` will be documented in this file.

## v2.1.0 - 2026-03-21

### Added

- Added Laravel 13 support.

### Fixed

- Fixed `INDEXNOW_PRODUCTION_ENV=false` so production-only submit gating can be disabled completely.
- Fixed `keyLocation` handling to send the public key file URL derived from `APP_URL`, with a fallback to `https://<host>` when `APP_URL` is empty.
- Fixed bulk URL submissions to send the expected `host` value and `urlList` payload.
- Fixed the registered `IndexNow` facade alias.

### Documentation

- Clarified the difference between `INDEXNOW_PRODUCTION_ENV` and `INDEXNOW_LOG_FAILED_SUBMITS`.
- Clarified how `INDEXNOW_KEY_LOCATION` maps to the public `keyLocation` URL.

## v2.0.1 - 2025-08-27

Moved Pest dep to dev-reqs

## v2.0.0 - 2025-03-13

### Changes

- Dropped Laravel 10 support
- Added Laravel 11 support

## v1.3.1 - 2025-01-05

Fixes php 8.4 implicit nullable type deprecation.

Thanks @it-can

## 1.3 - 2024-03-17

Laravel 11 support

## 1.2

Laravel 10 support

## 1.1 - 2022-06-19

Index submissions are only made on the configured production environment.

## 1.0 - 2022-06-16

IndexNow API wrapper for Laravel
