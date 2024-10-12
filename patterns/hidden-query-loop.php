<?php

/**
 * Title: Default Query Loop
 * Slug: base-theme/hidden-query-loop
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

<?php if ( is_home() && ! is_front_page() && ! empty( get_the_title() ) ) : ?>
	<header class="page-header alignwide">
		<!-- wp:post-title {"isLink":true,"fontSize":"x-large"} /-->
	</header>
<?php endif; ?>

<!-- wp:query {"queryId":0,"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true}} -->
<div class="wp-block-query">

	<!-- wp:post-template -->
	 <!-- wp:pattern {"slug":"base-theme/hidden-content"} /-->
	<!-- /wp:post-template -->

	<!-- wp:query-pagination -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->

	<!-- wp:query-no-results -->
		<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
		<p></p>
		<!-- /wp:paragraph -->
	<!-- /wp:query-no-results -->

</div>
<!-- /wp:query -->
