/**
 * Block Editor Customizations.
 */

/* WordPress dependencies.
   ========================================================================== */
import { unregisterBlockStyle, registerBlockStyle } from '@wordpress/blocks';
import {} from '@wordpress/dom-ready';
import {} from '@wordpress/edit-post';

/* Core / Image
   ========================================================================== */
wp.domReady( function() {

	// Remove default styling.
	unregisterBlockStyle(
		'core/image',
		[ 'default', 'rounded' ]
	);

} );

/* Core / Separator
		========================================================================== */
wp.domReady( function() {

	// Remove default styling.
	unregisterBlockStyle(
		'core/separator',
		[ 'default', 'wide', 'dots' ]
	);

} );

/* Core / Button
   ========================================================================== */
wp.domReady( function() {

	// Remove default styling.
	unregisterBlockStyle(
		'core/button',
		[ 'fill', 'outline' ]
	);

	registerBlockStyle(
		'core/button',
		{
			name: "primary",
			label: "Primary",
		}
	);

	registerBlockStyle(
		'core/button',
		{
			name: "secondary",
			label: "Secondary",
		}
	);

} );

/* Core / Quote
   ========================================================================== */
wp.domReady( function() {

	// Remove default styling.
	unregisterBlockStyle(
		'core/quote',
		[ 'default', 'plain']
	);

} );

/* Core / Table
   ========================================================================== */
wp.domReady( function() {

	// Remove default styling.
	unregisterBlockStyle(
		'core/table',
		[ 'default', 'stripes']
	);

} );

/* Core / Social Links
   ========================================================================== */
wp.domReady( function() {

	// Remove default styling.
	unregisterBlockStyle(
		'core/social-link',
		[ 'default', 'logos-only', 'pill-shape' ]
	);

} );

/* Core / Tag Cloud
   ========================================================================== */
wp.domReady( function() {

	// Remove default styling.
	unregisterBlockStyle(
		'core/tag-cloud',
		[ 'default', 'outline' ]
	);

} );
