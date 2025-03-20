<?php

/**
 * Title: Default Content
 * Slug: base-theme/hidden-404
 * Categories: query
 * Block Types: core/query
 * Description: Fallback template.
 *
 * @package   Vatu\Wordpress\Theme\Client\BaseTheme
 * @author    Vatu <hello@vatu.dev>
 * @link      https://vatu.dev/
 * @license   GNU General Public License v3 or later
 * @copyright 2022-2025 Vatu Limited.
 */

declare(strict_types=1);

?>

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading" id="page-not-found">
	<?php echo esc_html_x( text: 'Page not found', context: '404 error message', domain: 'base-theme' ); ?>
</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html_x( text: "We can't find the page you're looking for. The website administrators may have moved it, removed it, or restricted its visibility.", context: '404 error message', domain: 'base-theme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>
<?php echo esc_html_x( text: "Visit our homepage for more links or contact us and we'll help resolve your issue.", context: '404 more message', domain: 'base-theme' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( url: home_url() ); ?>"><?php echo esc_html_x( text: "Visit homepage", context: '404 home link', domain: 'base-theme' ); ?></a>
	</div>
	<!-- /wp:button -->

	<!-- wp:button {} -->
	<div class="wp-block-button">
		<a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( url: home_url( path: 'contact' ) ); ?>"><?php echo esc_html_x( text: "Contact us", context: '404 contact link', domain: 'base-theme' ); ?></a>
	</div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
