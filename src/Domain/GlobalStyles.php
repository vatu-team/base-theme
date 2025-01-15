<?php

/**
 * Global Styles.
 *
 * @package   Vatu\Wordpress\Theme\Client\BaseTheme
 * @author    Vatu <hello@vatu.dev>
 * @link      https://vatu.dev/
 * @license   GNU General Public License v3.0 or later
 * @copyright 2024-2025 Vatu Limited.
 */

declare(strict_types=1);

namespace Client\BaseTheme\Domain;

use ThoughtsIdeas\Wordpress\Infrastructure\Services\Registrable;
use ThoughtsIdeas\Wordpress\Infrastructure\Services\Service;

final class GlobalStyles extends Service implements Registrable
{
	protected string $name = 'Styles.Global';

	public function register(): void
	{
		\add_action(
			hook_name: 'wp_enqueue_scripts',
			callback: [ $this, 'enqueue' ],
			priority: 10,
			accepted_args: 0
		);

		\add_action(
			hook_name: 'admin_init',
			callback: [ $this, 'editor' ],
			priority: 10,
			accepted_args: 0
		);
	}

	public function enqueue(): void
	{
		$global_stylesheet = include_once get_theme_file_path( file: 'assets/css/global.asset.php' );

		\wp_enqueue_style(
			handle: 'base-theme-global-styles',
			src: \get_theme_file_uri( file: '/assets/css/global.css' ),
			deps: $global_stylesheet['dependencies'],
			ver: $global_stylesheet['version']
		);
	}

	public function editor(): void
	{
		\add_editor_style(
			stylesheet: [
				\get_theme_file_uri( file: '/assets/css/global.css' ),
			]
		);
	}
}
