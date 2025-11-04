<?php

/**
 * Title: Site Footer
 * Slug: base-theme/hidden-site-footer
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
<!-- wp:group {"tagName":"footer","metadata":{"name":"Site Footer"},"className":"c-site-footer","layout":{"type":"default"}} -->
<footer class="wp-block-group c-site-footer">

	<!-- wp:group {"metadata":{"name":"Footer Container"},"className":"c-site-footer__container","layout":{"type":"constrained"}} -->
	<div class="wp-block-group c-site-footer__container">

		<!-- wp:columns {"align":"wide"} -->
		<div class="wp-block-columns alignwide">

		<!-- wp:column {"metadata":{"name":"Content"},"className":"c-site-footer__content","width":"40%","layout":{"type":"constrained","contentSize":"350px","justifyContent":"left","wideSize":"340px"}} -->
		<div class="wp-block-column c-site-footer__content" style="flex-basis:40%">

			<!-- wp:image {"id":173,"width":"60px","height":"60px","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="https://docs.vatu.dev/app/uploads/sites/5/2025/08/logo.svg" alt="" class="wp-image-173" style="object-fit:cover;width:60px;height:60px"/></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"textAlign":"left","fontSize":"medium"} -->
			<h2 class="wp-block-heading has-text-align-left has-medium-font-size">Client name</h2>
			<!-- /wp:heading -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-secondary"} -->
				<div class="wp-block-button is-style-secondary"><a class="wp-block-button__link wp-element-button" href="#0">Get Started</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"metadata":{"name":"Menu"},"className":"c-site-footer__menu"} -->
		<div class="wp-block-column c-site-footer__menu">

			<!-- wp:heading {"level":2,"placeholder":"Menu Heading..."} -->
			<h2 class="wp-block-heading">Resources</h2>
			<!-- /wp:heading -->

			<!-- wp:navigation {"maxNestingLevel":0,"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"}} /-->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"metadata":{"name":"Menu"},"className":"c-site-footer__menu"} -->
		<div class="wp-block-column c-site-footer__menu">

			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">Company</h2>
			<!-- /wp:heading -->

			<!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"}} /-->

		</div>
		<!-- /wp:column -->

		<!-- wp:column {"metadata":{"name":"Menu"},"className":"c-site-footer__menu"} -->
		<div class="wp-block-column c-site-footer__menu">

			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">Help</h2>
			<!-- /wp:heading -->

			<!-- wp:navigation {"maxNestingLevel":0,"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"}} /-->

		</div>
		<!-- /wp:column -->
</div>
<!-- /wp:columns -->

		<!-- wp:group {"metadata":{"name":"Colophon"},"className":"c-site-footer__colophon","align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
		<div class="wp-block-group alignwide c-site-footer__colophon">

			<!-- wp:paragraph {"metadata":{"name":"Copyright","bindings":{"content":{"source":"base-theme/copyright"}}},"className":"c-site-footer__copyright"} -->
			<p class="c-site-footer__copyright"></p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"metadata":{"name":"Links"},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group">
				<!-- wp:navigation {"overlayMenu":"never"} /-->
			</div>
			<!-- /wp:group -->

			<!-- wp:paragraph {"metadata":{"name":"Credit","bindings":{"content":{"source":"base-theme/credit"}}},"className":"c-site-footer__credit"} -->
			<p class="c-site-footer__credit"><a href="https://vatu.dev">Website by Vatu</a></p>
			<!-- /wp:paragraph -->

	</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</footer>
<!-- /wp:group -->
