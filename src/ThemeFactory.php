<?php

/**
 * Theme Factory.
 *
 * @package   Vatu\Wordpress\Theme\Client\BaseTheme
 * @author    Vatu <hello@vatu.dev>
 * @link      https://vatu.dev/
 * @license   GNU General Public License v3.0 or later
 * @copyright 2024 Vatu Limited.
 */

declare(strict_types=1);

namespace Client\BaseTheme;

final class ThemeFactory
{
	private static null|Theme $theme = null;

	/**
	 * Create and return an instance of the theme.
	 */
	public static function create( string $hook_prefix ): Theme
	{
		if ( is_null( self::$theme ) ) {
			self::$theme = new Theme( hook_prefix: $hook_prefix );
		}

		return self::$theme;
	}
}
