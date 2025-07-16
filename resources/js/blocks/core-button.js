/**
 * External dependencies
 */
// import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { addFilter } from '@wordpress/hooks';

/**
 * Add the attributes needed for button icons.
 *
 * @since 0.1.0
 * @param {Object} settings
 */
function addAttributes( settings ) {
	if ( 'core/button' !== settings.name ) {
		return settings;
	}

	// Add the custom attributes
	const iconAttributes = {
		icon: {
			type: 'string',
		},
		iconPositionStart: {
			type: 'boolean',
			default: true,
		},
		hideText: {
			type: 'boolean',
			default: false,
		},
	};

	const newSettings = {
		...settings,
		attributes: {
			...settings.attributes,
			...iconAttributes,
		},
	};

	return newSettings;
}

addFilter(
	'blocks.registerBlockType',
	'vatu/add-attributes',
	addAttributes
);
