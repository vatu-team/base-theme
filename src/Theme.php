<?php

/**
 * Theme.
 *
 * @package   Vatu\Wordpress\Theme\Client\BaseTheme
 * @author    Vatu <hello@vatu.dev>
 * @link      https://vatu.dev/
 * @license   GNU General Public License v3.0 or later
 * @copyright 2023-2024 Vatu Limited.
 */

declare(strict_types=1);

namespace Client\BaseTheme;

use ThoughtsIdeas\Wordpress\Infrastructure\Main;
use ThoughtsIdeas\Wordpress\Infrastructure\Services\ServiceProvider;

final class Theme extends ServiceProvider implements Main
{
	/**
	 * WordPress action to trigger the service registration on.
	 */
	protected string $registration_action = 'after_setup_theme';

	protected string $identifier = 'base';

	/**
	 * Service to be loaded.
	 *
	 * @var array<string>
	 */
	protected array $service_collection = [
		Domain\BlockPatterns::class,
		Domain\EditorScript::class,
		Domain\GlobalStyles::class,
		Domain\Openverse::class,
	];

	/**
	 * Register the services with WordPress.
	 */
	public function bootstrap(): void
	{
		\add_action(
			$this->registration_action,
			[ $this, 'initializeServiceCollection' ],
			10,
			0
		);
	}
}
