<?php

/**
 * Title Format
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

final class TitleFormat extends Service implements Registrable
{
	protected string $name = 'TitleFormat';

	public function register(): void
	{
		\add_filter(
			hook_name: 'private_title_format',
			callback: [ $this, 'removePrivateLabel' ],
			priority: 10,
			accepted_args: 0
		);

		\add_filter(
			hook_name: 'protected_title_format',
			callback: [ $this, 'removePrivateLabel' ],
			priority: 10,
			accepted_args: 0
		);
	}

	public function removePrivateLabel(): string
	{
		return '%s';
	}

	public function removeProtectedLabel(): string
	{
		return '%s';
	}
}
