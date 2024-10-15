<?php

/**
 * Archive Title
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

final class ArchiveTitle extends Service implements Registrable
{
	protected string $name = 'Archive.Title';

	public function register(): void
	{
		\add_filter(
			hook_name: 'get_the_archive_title_prefix',
			callback: [ $this, 'unsetValue' ],
			priority: 10,
			accepted_args: 0
		);
	}

	public function unsetValue(): string
	{
		return '';
	}
}
