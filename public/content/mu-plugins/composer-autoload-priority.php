<?php

/**
 * Plugin Name: Composer Autoload Priority
 * Description: Keeps the project's Composer autoloader ahead of autoloaders bundled in plugins.
 *
 * Plugins such as All in One SEO Pro ship unprefixed copies of shared libraries (Monolog 1, PSR Log 1)
 * and register their Composer autoloader with `prepend`. Acorn then resolves those old versions and
 * fatals the first time it logs something. Re-prepending the project loader after each plugin loads
 * means our dependency versions always win.
 */

use Composer\Autoload\ClassLoader;

$vendor = dirname(__DIR__, 3) . '/vendor';

add_action('plugin_loaded', function () use ($vendor): void {
    $loader = ClassLoader::getRegisteredLoaders()[$vendor] ?? null;

    $loader?->unregister();
    $loader?->register(true);
});
