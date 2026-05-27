# Change Log for the Eightshift Boilerplate Plugin

All notable changes to this project will be documented in this file.

This projects adheres to [Semantic Versioning](https://semver.org/) and [Keep a CHANGELOG](https://keepachangelog.com/).

## [7.0.0]

### Added

- Added `rector/rector` as a dev dependency along with `test:rector`, `fix:rector`, and `fix:standards` Composer scripts.
- Added `phpstan/phpstan-deprecation-rules` to surface deprecation usage during static analysis.
- Added `php-stubs/wordpress-stubs` for accurate WordPress type information in PHPStan.
- Added `roave/security-advisories` to block installation of dependencies with known security advisories.
- Added `void` return type to activation and deactivation hook closures.

### Changed

- Bumped minimum PHP version from `8.3` to `8.4`.
- Bumped `infinum/eightshift-libs` from `^11.0.4` to `^12.3.4` (major upgrade).
- Bumped `infinum/eightshift-coding-standards` from `^3.0.0` to `^4.0.2` (major upgrade).
- Bumped `dealerdirect/phpcodesniffer-composer-installer` from `1.2.0` to `1.2.1`.
- Switched object instantiation to PHP 8.4 "new without parentheses" syntax: `(new Foo())->bar()` → `new Foo()->bar()`.
- Switched action callbacks to first-class callable syntax: `[$this, 'method']` → `$this->method(...)`.
- PHPStan now scans the entire project root (with explicit excludes) and bootstraps WordPress stubs.
- PHPCS `testVersion` raised from `8.3-` to `8.4-`.
- Prettier `printWidth` increased from `180` to `300`.

### Removed

- Removed redundant `@return void` PHPDoc tags now covered by native return types.
- Removed `Generic.Files.LineLength.TooLong` exclusion from PHPCS ruleset.
- Removed `pestphp/pest-plugin` from Composer `allow-plugins`.
- Removed PHPStan `ignoreErrors` block (no longer needed).

### Migration guide

Upgrading from `6.x` to `7.0.0` is a breaking change. Follow these steps:

1. **PHP version** — ensure your server runs PHP `8.4+`. Update your `composer.json` `require.php` constraint to `">=8.4"`.
2. **Dependencies** — bump in your project `composer.json`:
   - `infinum/eightshift-libs`: `^12.0`
   - `infinum/eightshift-coding-standards`: `^4.0`
   - Then run `composer update`.
3. **PHP 8.4 syntax** — if you maintain a plugin based on a previous boilerplate version, run Rector to migrate object instantiation and callable patterns:
   ```bash
   composer require --dev rector/rector
   composer fix:rector
   ```
4. **PHPStan config** — add the deprecation rules include and WordPress stubs bootstrap to your `phpstan.neon.dist`:
   ```yaml
   includes:
     - vendor/phpstan/phpstan-deprecation-rules/rules.neon
   parameters:
     bootstrapFiles:
       - %rootDir%/../../php-stubs/wordpress-stubs/wordpress-stubs.php
   ```
5. **PHPCS config** — raise `testVersion` to `8.4-` in `phpcs.xml.dist`.
6. **Strauss** — re-run `composer prefix-namespaces` after updating to rebuild the prefixed vendor directory against the new `eightshift-libs` major.
7. **Verify** — run `composer test` (Rector, PHPCS, PHPStan) and resolve any remaining issues before deploying.

## [6.0.0]

### Changed

- Updating project to ba a minimal plugin boilerplate.

## [5.0.1]

### Changed

- Main CLI command prefix.

## [5.0.0]

### Update

- Boilerplate is clean and is using only temporary files used for the initial setup. After running the setup, the temporary files are removed and replaced with the actual files.
- Minimum PHP version is now 8.2+.

## [4.0.0]

### Update

- Updating packages.
- Full change log can be checked on Github [frontend-libs release](https://github.com/infinum/eightshift-frontend-libs/releases/tag/8.0.0) and [libs release](https://github.com/infinum/eightshift-libs/releases/tag/6.4.0).

## [3.0.0]

### Update

- Updating packages
- Full change log can be checked on Github [frontend-libs release](https://github.com/infinum/eightshift-frontend-libs/releases/tag/7.0.0) and [libs release](https://github.com/infinum/eightshift-libs/releases/tag/6.0.0).

## [2.0.0]

### Update

- Major braking changes do to updates on css variables, and helpers.

## [1.3.0]

### Changed

- `Eightshift-frontend-libs` update.
- `Eightshift-libs` update.
- `composer.json` updated packages, fixing scripts names.

## [1.2.2]

### Changed

- `Eightshift-frontend-libs` update.
- `Eightshift-libs` update.

## [1.2.1]

### Changed

- `Eightshift-frontend-libs` update.
- `Eightshift-libs` update.

* Modified const name in wp-config-project.php from ES_ENV to EB_ENV to be consistent with the rest of the project.
* Added eslint rule to ignore external dependencies from @eightshift/frontend-libs.

## [1.2.0]

### Changed

- `Eightshift-frontend-libs` update.
- `Eightshift-libs` update.

### Removed

- Removed `Config` dependency from enqueue classes
- Removed .babelrc file.

### Added

- Added babel.config.js

**BRAKING CHANGES:**

- Please replace you old .babelrc file with the new one babel.config.js and convert it from .json to .js format.

## [1.1.0]

### Changed

- Eightshift-frontend-libs update.
- Eightshift-libs update.

## [1.0.2]

### Changed

- Eightshift-frontend-libs update
- Eightshift-libs update

## [1.0.1]

### Changed

- Eightshift-frontend-libs update
- Eightshift-libs update
- Fixing readme.

## [1.0.0]

Initial tagged release.

[Unreleased]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/master...HEAD
[7.0.0]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/6.0.0...7.0.0
[6.0.0]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/5.0.1...6.0.0
[5.0.1]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/5.0.0...5.0.1
[5.0.0]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/4.0.0...5.0.0
[4.0.0]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/3.0.0...4.0.0
[3.0.0]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/2.0.0...3.0.0
[2.0.0]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/v1.3.0...2.0.0
[1.3.0]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/v1.2.2...v1.3.0
[1.2.2]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/v1.2.1...v1.2.2
[1.2.1]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/v1.2.0...v1.2.1
[1.2.0]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/v1.0.2...v1.1.0
[1.0.2]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/v1.0.1...v1.0.2
[1.0.1]: https://github.com/infinum/eightshift-boilerplate-plugin/compare/v1.0.0...v1.0.1
