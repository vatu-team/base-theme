<?php

/**
 * Copyright
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

final class Copyright extends Service implements Registrable
{
	protected string $name = 'Copyright';

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
			source_name: 'base-theme/copyright',
			source_properties: [
				'label'              => __( 'Copyright year', 'base-theme' ),
				'get_value_callback' => [ $this, 'copyrightOutput' ],
			]
		);
	}

	public function copyrightOutput(): string
	{
		return sprintf(
			'&copy; %s %s',
			gmdate( 'Y' ),
			get_bloginfo( 'name' )
		);
	}
}
