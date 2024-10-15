<?php

/**
 * Block Patterns.
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

final class BlockPatterns extends Service implements Registrable
{
	protected string $name = 'BlockPatterns';

	public function register(): void
	{
		\add_filter(
			hook_name: 'should_load_remote_block_patterns',
			callback: [ $this, 'disableRemote' ],
			priority: 10,
			accepted_args: 0
		);

		\add_action(
			hook_name: 'init',
			callback: [ $this, 'disableCore' ],
			priority: 99,
			accepted_args: 0
		);
	}

	public function disableRemote(): bool
	{
		return false;
	}

	public function disableCore(): void
	{
		\remove_theme_support( feature: 'core-block-patterns' );
	}
}
