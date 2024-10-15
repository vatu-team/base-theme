<?php

/**
 * Global Scripts.
 *
 * @package   Vatu\Wordpress\Theme\Client\BaseTheme
 * @author    Vatu <hello@vatu.dev>
 * @link      https://vatu.dev/
 * @license   GNU General Public License v3.0 or later
 * @copyright 2024 Vatu Limited.
 */

declare(strict_types=1);

namespace Client\BaseTheme\Domain;

use ThoughtsIdeas\Wordpress\Infrastructure\Services\Registrable;
use ThoughtsIdeas\Wordpress\Infrastructure\Services\Service;

final class GlobalScripts extends Service implements Registrable
{
	protected string $name = 'Scripts.Global';

	public function register(): void
	{
		\add_action(
			hook_name: 'wp_enqueue_scripts',
			callback: [ $this, 'enqueue' ],
			priority: 10,
			accepted_args: 0
		);
	}

	public function enqueue(): void
	{
		$script_asset = include_once get_theme_file_path( file: 'assets/js/global.asset.php' );

		\wp_enqueue_script(
			handle: 'base-theme-script',
			src: \get_theme_file_uri( file: '/assets/js/global.js' ),
			deps: $script_asset['dependencies'],
			ver: $script_asset['version']
		);
	}
}
