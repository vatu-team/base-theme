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
			<figure class="wp-block-image size-full is-resized"><img src="https://docs.vatu.dev/app/uploads/sites/5/2025/08/logo-1.svg" alt="" class="wp-image-173" style="object-fit:cover;width:60px;height:60px"/></figure>
			<!-- /wp:image -->

			<!-- wp:heading {"textAlign":"left","fontSize":"medium"} -->
			<h2 class="wp-block-heading has-text-align-left has-medium-font-size">Client name</h2>
			<!-- /wp:heading -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"}} -->
			<div class="wp-block-buttons"><!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Get Started</a></div>
			<!-- /wp:button --></div>
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

			<!-- wp:group {"metadata":{"name":"Links and Social"},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group">
				<!-- wp:navigation {"maxNestingLevel":0,"overlayMenu":"never"} /-->

				<!-- wp:social-links {"size":"has-normal-icon-size","className":"is-style-logos-only","style":{"spacing":{"blockGap":{"left":"12px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<ul class="wp-block-social-links has-normal-icon-size is-style-logos-only"><!-- wp:social-link {"url":"#","service":"facebook"} /-->

				<!-- wp:social-link {"url":"#","service":"instagram"} /--></ul>
				<!-- /wp:social-links -->
			</div>
			<!-- /wp:group -->

		<!-- wp:paragraph {"metadata":{"name":"Credit","bindings":{"content":{"source":"core/pattern-overrides"}}},"className":"c-site-footer__credit"} -->
		<p class="c-site-footer__credit">Site by Vatu</p>
		<!-- /wp:paragraph --></div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

</footer>
<!-- /wp:group -->
