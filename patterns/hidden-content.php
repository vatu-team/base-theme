<?php

/**
 * Title: Default Content
 * Slug: base-theme/hidden-content
 * Categories: query
 * Block Types: core/query
 * Description: Fallback template.
 *
 * @package   Vatu\Wordpress\Theme\Client\BaseTheme
 * @author    Vatu <hello@vatu.dev>
 * @link      https://vatu.dev/
 * @license   GNU General Public License v3 or later
 * @copyright 2022-2024 Vatu Limited.
 */

declare(strict_types=1);

?>

<!-- wp:group {"tagName":"article","metadata":{"name":"Site"},"layout":{"type":"constrained"}} -->
<article class="wp-block-group">

	<?php if ( is_singular() ) : ?>
		<!-- wp:post-title {"level":1,"fontSize":"xlarge"} /-->
	<?php else : ?>
		<!-- wp:post-title {"level":2,"fontSize":"large","isLink":true} /-->
	<?php endif; ?>

	<!-- wp:post-featured-image {"aspectRatio":"3/2"} /-->

	<!-- wp:template-part {"slug":"post-meta"} /-->

	<!-- wp:post-content {"lock":{"move":false,"remove":true},"tagName":"main","metadata":{"name":"Content"},"align":"full","layout":{"type":"constrained"}} /-->

</article>
<!-- /wp:group -->
