<?php

/**
 * Copyright
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

final class ButtonIcon extends Service implements Registrable
{
	protected string $name = 'ButtonIcon';

	public function register(): void
	{
		\add_action(
			hook_name: 'enqueue_block_editor_assets',
			callback: [ $this, 'extendCoreButton' ],
			priority: 10,
			accepted_args: 0
		);
	}

	public function extendCoreButton(): void
	{
		$script = include_once get_theme_file_path( file: 'assets/js/blocks/core-button.asset.php' );

		\wp_enqueue_script(
			handle: 'extend-core-buttons',
			src: \get_theme_file_uri( file: '/assets/js/blocks/core-button.js' ),
			deps: $script['dependencies'],
			ver: $script['version']
		);
	}
}
