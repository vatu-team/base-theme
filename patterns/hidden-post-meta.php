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
 * @copyright 2022-2025 Vatu Limited.
 */

declare(strict_types=1);

?>

<!-- wp:group {"className":"c-post-meta","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group c-post-meta"><!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:avatar {"size":56} /-->

<!-- wp:group {"className":"c-post-meta__details","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group c-post-meta__details"><!-- wp:post-author {"showAvatar":false,"showBio":false,"isLink":true} /-->

<!-- wp:group {"className":"c-post-meta__info","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group c-post-meta__info"><!-- wp:post-date {"format":"<?php echo get_option( 'date_format' ); ?>","isLink":false} /-->

<!-- wp:paragraph -->
<p>•</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>5 min read</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
