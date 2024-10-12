<?php

/**
 * Title: Post Meta
 * Slug: base-theme/hidden-post-meta
 * Inserter: no
 *
 * @package   Vatu\Wordpress\Theme\Client\BaseTheme
 * @author    Vatu <hello@vatu.dev>
 * @link      https://vatu.dev/
 * @license   GNU General Public License v3 or later
 * @copyright 2022-2024 Vatu Limited.
 */

declare(strict_types=1);

?>

<!-- wp:group {"layout":{"type":"constrained"}, "className":"c-post-meta} -->
<div class="wp-block-group c-post-meta">

	<!-- wp:group {"style":{"spacing":{"blockGap":"0.3em"}},"layout":{"type":"flex","justifyContent":"left"}} -->
	<div class="wp-block-group">

		<!-- wp:paragraph -->
		<p><?php echo esc_html_x( 'Author:', 'Prefix for the post author block: By author name', 'base-theme' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:post-author-name {"isLink":false} /-->

		<!-- wp:paragraph -->
		<p> • </p>
		<!-- /wp:paragraph -->

		<!-- wp:post-date {"format":"<?php echo get_option( 'date_format' ); ?>","isLink":false} /-->

	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
