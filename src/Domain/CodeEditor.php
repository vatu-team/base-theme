<?php

/**
 * Code Editor.
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

final class CodeEditor extends Service implements Registrable
{
	protected string $name = 'CodeEditor';

	public function register(): void
	{
		\add_filter(
			hook_name: 'block_editor_settings_all',
			callback: [ $this, 'disable' ],
			priority: 10,
			accepted_args: 1
		);
	}

	/**
	 * Disable non Administrators from edith the Code behind a post/page/
	 *
	 * phpcs:ignore SlevomatCodingStandard.TypeHints.DisallowMixedTypeHint.DisallowedMixedTypeHint -- Supplied by WordPress.
	 * @param array<string,mixed> $settings
	 * phpcs:ignore SlevomatCodingStandard.TypeHints.DisallowMixedTypeHint.DisallowedMixedTypeHint -- Required by WordPress.
	 * @return array<string,mixed>
	 */
	public function disable( array $settings ): array
	{
		$user = \get_userdata( user_id: get_current_user_id() );

		if ( ! ( $user instanceof \WP_User ) ) {
			return $settings;
		}

		if ( $user->allcaps['edit_files'] === false ) {
			$settings['codeEditingEnabled'] = false;
		}

		return $settings;
	}
}
