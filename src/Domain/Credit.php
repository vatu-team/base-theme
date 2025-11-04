<?php

/**
 * Credit
 *
 * @package   Vatu\Wordpress\Theme\Client\BaseTheme
 * @author    Vatu <hello@vatu.dev>
 * @link      https://vatu.dev/
 * @license   GNU General Public License v3.0 or later
 * @copyright 2025 Vatu Limited.
 */

declare(strict_types=1);

namespace Client\BaseTheme\Domain;

use ThoughtsIdeas\Wordpress\Infrastructure\Services\Registrable;
use ThoughtsIdeas\Wordpress\Infrastructure\Services\Service;

final class Credit extends Service implements Registrable
{
	protected string $name = 'Credit';

	public function register(): void
	{
		\add_action(
			hook_name: 'init',
			callback: [ $this, 'blockBinding' ],
			priority: 10,
			accepted_args: 0
		);
	}

	public function blockBinding(): void
	{
		register_block_bindings_source(
			source_name: 'base-theme/credit',
			source_properties: [
				'label'              => __( 'Theme Author', 'base-theme' ),
				'get_value_callback' => [ $this, 'themeAuthor' ],
			]
		);
	}

	public function themeAuthor(): string
	{
		$text = sprintf(
			'Site By %s',
			esc_html( 'Vatu' )
		);


		return sprintf(
			'<a href="%2$s">%1$s</a>',
			esc_html( $text ),
			esc_url( 'https://vatu.dev/' )
		);
	}
}
