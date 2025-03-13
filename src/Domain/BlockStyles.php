<?php

/**
 * Global Styles.
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

final class BlockStyles extends Service implements Registrable
{
	protected string $name = 'BlockStyles';

	/**
	 * @var array<string>
	 */
	private array $block_list = [
		'core/image',
		'core/quote',
		'core/separator',
		'core/table',
		'core/verse',
	];

	public function register(): void
	{
		\add_action(
			hook_name: 'init',
			callback: [
				$this,
				'registerBlockCss',
			],
			priority: 10,
			accepted_args: 0
		);
	}

	public function registerBlockCss(): void
	{
		foreach ( $this->getBlockList() as $block ) {
			$slug = str_replace(
				search: '/',
				replace: '-',
				subject: $block
			);

			\wp_enqueue_block_style(
				block_name: $block,
				args: [
					'handle' => "base-theme-block-{$slug}",
					'src'    => \get_theme_file_uri( "assets/css/blocks/{$slug}.css" ),
					'deps'   => [],
					'ver'    => null,
					'path'   => \get_theme_file_path( "assets/css/blocks/{$slug}.css" ),
				]
			);
		}
	}

	/**
	 * @return array<string>
	 */
	private function getBlockList(): array
	{
		return apply_filters(
			$this->getHook(),
			$this->block_list
		);
	}
}
