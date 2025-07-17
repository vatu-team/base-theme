/**
 * External dependencies
 */
// import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, PanelRow, ToggleControl, __experimentalToggleGroupControl as ToggleGroupControl, __experimentalToggleGroupControlOptionIcon as ToggleGroupControlOptionIcon } from '@wordpress/components';
import { justifyLeft, justifyRight } from '@wordpress/icons';
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
		iconPosition: {
			type: 'enum',
			default: 'start',
			enum: [ 'start', 'end' ],
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
	'core-button/add-attributes',
	addAttributes
);

function addInspectorControls( BlockEdit ) {
	return ( props ) => {
		const { name, attributes, setAttributes } = props;

		if ( name !== 'core/button' ) {
			return <BlockEdit { ...props } />;
		}

		// Retrieve selected attributes from the block.
		const { icon, iconPosition, hideText } = attributes;

		return (
			<>
				<BlockEdit { ...props } />
				<InspectorControls>
					<PanelBody
						title={ __(
							'Icon',
							'base-theme'
						) }
					>
						<PanelRow>
							<ToggleControl
								label={ __( 'Hide text', 'base-theme' ) }
								checked={ hideText }
								onChange={ () => {
									setAttributes( {
										hideText: ! hideText,
									} );
								} }
							/>
						</PanelRow>
						<PanelRow>
							<ToggleGroupControl
								__next40pxDefaultSize
								__nextHasNoMarginBottom
								isBlock
								label={ __( 'Icon position', 'base-theme' ) }
								onChange={ (value) => {
									setAttributes( { iconPosition: value } );
								} }
							>
								<ToggleGroupControlOptionIcon
									value="start"
									icon={ justifyLeft }
									label={ __( 'Prepend', 'base-theme' ) }
								/>
								<ToggleGroupControlOptionIcon
									value="end"
									icon={ justifyRight }
									label={ __( 'Append', 'base-theme' ) }
								/>
							</ToggleGroupControl>
						</PanelRow>
					</PanelBody>
				</InspectorControls>
			</>
		);
	};
}

addFilter(
	'editor.BlockEdit',
	'core-button/add-inspector-controls',
	addInspectorControls
);
