<?php

/**
 * WordPress Patterns.
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

final class Patterns extends Service implements Registrable
{
	protected string $name = 'Patterns';

	public function register(): void
	{
		\add_action(
			hook_name: 'admin_menu',
			callback: [ $this, 'addMenu' ],
			priority: 99,
			accepted_args: 1
		);
	}

	public function addMenu(): void
	{
		if ( ! is_admin() || ! is_admin_bar_showing() ) {
			return;
		}

		if ( ! current_user_can( capability: 'edit_pages' ) ) {
			return;
		}

		\add_menu_page(
			page_title: __( ' Patterns', 'base-theme' ),
			menu_title: __( ' Patterns', 'base-theme' ),
			capability: 'edit_pages',
			menu_slug: 'edit.php?post_type=wp_block',
			icon_url: 'dashicons-layout',
			position: 11
		);
	}
}
