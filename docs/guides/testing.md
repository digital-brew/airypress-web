# Testing Guide

This guide covers how to run and work with tests in Radicle projects.

## Testing Stack

- **Pest** for PHP unit and integration tests
- **Playwright** for end-to-end browser testing

## Running PHP Tests

```bash
composer test           # Run all PHP tests
vendor/bin/pest        # Run with Pest directly
vendor/bin/pest --coverage  # Run with coverage report
```

## Running E2E Tests

```bash
npx playwright test              # Run all E2E tests
npx playwright test --headed     # Run with visible browser
npx playwright test --ui         # Run with Playwright UI
```

## Test Files

- **PHP tests**: Located in `tests/` directory
- **E2E tests**: Located in `tests/e2e/` directory
- **Existing tests**: Check current test files for examples and patterns

## Configuration Files

- `phpunit.xml` - PHP test configuration and coverage settings
- `playwright.config.js` - E2E test configuration and browser settings

## Writing New Tests

For PHP tests, follow the existing Pest patterns in the `tests/` directory.

For E2E tests, follow the existing Playwright patterns in `tests/e2e/`.
