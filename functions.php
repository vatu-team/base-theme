<?php

/**
 * Theme Functions
 *
 * @package   Vatu\Wordpress\Theme\Client\BaseTheme
 * @author    Vatu <hello@vatu.dev>
 * @link      https://vatu.dev/
 * @license   GNU General Public License v3 or later
 * @copyright 2022-2024 Vatu Limited.
 */

declare(strict_types=1);

namespace Client\BaseTheme;

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * Scope hooks identifier.
 */
const HOOK_PREFIX = 'Vatu';

/**
 * Autoloader.
 */
$composer_autoloader = __DIR__ . '/vendor/autoload.php';

if ( is_readable( $composer_autoloader ) ) {
	require $composer_autoloader;
}

try {
	( new ThemeFactory() )::create( hook_prefix: HOOK_PREFIX )->bootstrap();
} catch ( Throwable $exception ) {
	// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log, Squiz.PHP.DiscouragedFunctions.Discouraged
	error_log( $exception->getMessage() );
}
