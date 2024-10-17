<?php

/**
 * Template Editor.
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

final class TemplateEditor extends Service implements Registrable
{
	protected string $name = 'TemplateEditor';

	/**
	 * @var array<string>
	 */
	private array $disallow_list = [
		'post',
	];

	public function register(): void
	{
		\add_action(
			hook_name: 'current_screen',
			callback: [ $this, 'disableTemplate' ],
			priority: 10,
			accepted_args: 0
		);
	}

	public function disableTemplate(): void
	{
		$current_screen = \get_current_screen();

		if (
			isset( $current_screen->post_type ) &&
			! in_array( needle: $current_screen->post_type, haystack: $this->disallow_list, strict: true )
		) {
			return;
		}

		\remove_theme_support( feature: 'block-templates' );
	}
}
