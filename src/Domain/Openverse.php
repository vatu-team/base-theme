<?php

/**
 * Openverse.
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

final class Openverse extends Service implements Registrable
{
	protected string $name = 'Openverse';

	public function register(): void
	{
		\add_filter(
			hook_name: 'block_editor_settings_all',
			callback: [ $this, 'disableOpenverse' ],
			priority: 10,
			accepted_args: 1
		);
	}

	/**
	 * @param array<string,mixed> $settings
	 * @return array<string,mixed>
	 */
	public function disableOpenverse( array $settings ): array
	{
		$settings['enableOpenverseMediaCategory'] = false;

		return $settings;
	}
}
