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

		\add_filter(
			hook_name: 'render_block_core/button',
			callback: [ $this, 'renderCoreButton' ],
			priority: 10,
			accepted_args: 2
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

	/**
	 * @param array<mixed> $block
	 */
	public function renderCoreButton( string $block_content, array $block ): string
	{

		// if ( ! isset( $block['attrs']['icon'] ) ) {
		// 	return $block_content;
		// }

		$icon      = $block['attrs']['icon'];
		$position  = $block['attrs']['iconPosition'];
		$hide_text = $block['attrs']['hideText'];


		// Append the icon class to the block.
		$processer = new \WP_HTML_Tag_Processor( html: $block_content );

		if ( $processer->next_tag() ) {
			$processer->add_class( class_name: 'has-icon' );
		}

		$result = $processer->get_updated_html();

		$icon_html = sprintf(
			'<span class="c-icon"><svg aria-hidden="%2$s"><use href="%1$s"></use></svg></span>',
			esc_url( get_stylesheet_directory_uri() . "/assets/svg/icons.svg#{$icon}" ),
			'true'
		);

		$hide_html = $hide_text ? ' screen-reader-text' : null;

		$result = $position
			? preg_replace(
				'/(<a[^>]*>)(.*?)(<\/a>)/i',
				"$1{$icon_html}" . '<span class="wp-block-button__label' . $hide_html . '">$2</span>$3',
				$result
			)
			: preg_replace(
				'/(<a[^>]*>)(.*?)(<\/a>)/i',
				'$1<span class="wp-block-button__label' . $hide_html . '">$2</span>' . $icon_html . '$3',
				$result
			);

		if ( ! is_string( $result ) ) {
			return $block_content;
		}

		return $result;
	}
}
