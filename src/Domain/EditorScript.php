<?php

/**
 * Editor Script: Customise block styles.
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

final class EditorScript extends Service implements Registrable
{
	protected string $name = 'editor.script';

	public function register(): void
	{
		\add_action(
			hook_name: 'enqueue_block_editor_assets',
			callback: [ $this, 'enqueue' ],
			priority: 10,
			accepted_args: 0
		);
	}

	public function enqueue(): void
	{
		$script_asset = include_once \get_theme_file_path( 'assets/js/editor.asset.php' );

		\wp_enqueue_script(
			handle: 'editor-script',
			src: \get_theme_file_uri( file: '/assets/js/editor.js' ),
			deps: $script_asset['dependencies'],
			ver: $script_asset['version']
		);
	}
}
