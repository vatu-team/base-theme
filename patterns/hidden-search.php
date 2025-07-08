<?php

/**
 * Title: Search Results Page
 * Slug: base-theme/search
 * Categories: query
 * Description: Display search block and results.
 * Viewport Width: 1024px
 * Inserter: true
 * Keywords: search
 *
 *
 * @package   Vatu\Wordpress\Theme\Client\BaseTheme
 * @author    Vatu <hello@vatu.dev>
 * @link      https://vatu.dev/
 * @license   GNU General Public License v3 or later
 * @copyright 2022-2025 Vatu Limited.
 */

declare(strict_types=1);

?>

<!-- wp:group {"metadata":{"name":"Search Field"},"tagName":"header","align":"full","className":"c-search-field","layout":{"type":"constrained"}} -->
<header class="wp-block-group alignfull c-search-field"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading" id="page-not-found"><?php echo esc_html_x( 'Search', 'search title', 'base-theme' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search","buttonText":"Search"} /--></header>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Search Results"},"tagName":"article","align":"full","className":"c-search-results","layout":{"type":"constrained"}} -->
<article class="wp-block-group alignfull c-search-results">

	<!-- wp:query-title {"type":"search","level":2,"fontSize":"medium"} /-->

	<!-- wp:query {"query":{"perPage":12,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[],"format":[]},"enhancedPagination":true} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"className":"c-search-results__loop"} -->
		<!-- wp:group {"className":"c-search-results__item","layout":{"type":"constrained"}} -->
		<div class="wp-block-group c-search-results__item">
			<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"small"} /-->
			<!-- wp:post-excerpt {"excerptLength":22} /-->
		</div>
		<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"className":"c-pagination"} -->
		<!-- wp:query-pagination-previous {"label":"Prev","className":"c-pagination__prev"} /-->

		<!-- wp:query-pagination-numbers {"className":"c-pagination__numbers"} /-->

		<!-- wp:query-pagination-next {"label":"Next","className":"c-pagination__next"} /-->
		<!-- /wp:query-pagination -->

		<!-- wp:query-no-results -->
		<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
		<p></p>
		<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</article>
<!-- /wp:group -->
