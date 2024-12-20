<?php

/**
 * Block Editor.
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

final class BlockEditor extends Service implements Registrable
{
	protected string $name = 'BlockEditor';

	public function register(): void
	{
		\add_filter(
			hook_name: 'allowed_block_types_all',
			callback: [$this,'example_allowed_block_types_when_editing_posts'],
			priority: 10,
			accepted_args: 2
		);
	}

	/**
	 * @param array<string>|bool $allowed_block_types
	 * @return array<string>|bool
	 */
	function example_allowed_block_types_when_editing_posts(
		bool|array $allowed_block_types,
		\WP_Block_Editor_Context $block_editor_context
	): array|bool {
		if ( $this->isRestrictedType( context: $block_editor_context ) ) {
			$allowed_block_types = [
				// Text Blocks.
				'core/paragraph',
				'core/heading',
				'core/list',
				'core/list-item',
				'core/quote',
				'core/code',
				'core/details',
				'core/qullquote',
				'core/table',
				'core/verse',
				// Media Blocks.
				'core/image',
				'core/gallery',
				'core/audio',
				'core/cover',
				'core/file',
				'core/video',
				// Design
				'core/buttons',
				'core/button',
				'core/nextpage',
				'core/separator',
				'core/page-list',
				// Embeds Blocks.
				'core/embed',
			];

			return $allowed_block_types;
		}

		return true;
	}

	private function isRestrictedType( \WP_Block_Editor_Context $context ): bool
	{
		return 'core/edit-post' === $context->name &&
			isset( $context->post ) &&
			'post' === $context->post->post_type;
	}
}
