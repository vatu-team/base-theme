/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { Icon, Button, PanelBody, PanelRow, ToggleControl, __experimentalToggleGroupControl as ToggleGroupControl, __experimentalToggleGroupControlOptionIcon as ToggleGroupControlOptionIcon, __experimentalGrid as Grid } from '@wordpress/components';
import { justifyLeft, justifyRight } from '@wordpress/icons';
import { addFilter } from '@wordpress/hooks';
import { SVG } from '@wordpress/primitives';

export const ICON_SPRITE = [
	{
		label: __( 'BlueSky', 'extended-core-buttons' ),
		value: 'bluesky',
	},
	{
		label: __( 'Facebook', 'extended-core-buttons' ),
		value: 'facebook',
	},
	{
		label: __( 'Instagram', 'extended-core-buttons' ),
		value: 'instagram',
	},
	{
		label: __( 'LinkedIn', 'extended-core-buttons' ),
		value: 'linkedin',
	},
	{
		label: __( 'Twitter', 'extended-core-buttons' ),
		value: 'twitter',
	},
];

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
			role: 'content',
		},
		iconPosition: {
			type: 'enum',
			default: 'start',
			enum: [ 'start', 'end' ],
			role: 'content',
		},
		hideText: {
			type: 'boolean',
			default: false,
			role: 'content',
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
		const { icon: currentIcon, iconPosition, hideText } = attributes;

		return (
			<>
				<BlockEdit { ...props } />
				<InspectorControls>
					<PanelBody
						title={ __(
							'Icon',
							'base-theme'
						) }
						className="icon-settings-panel"
						initialOpen
					>

						<PanelRow>
							<Grid
								className="button-icon-picker__grid"
								columns="5"
								gap="0"
							>
								{ ICON_SPRITE.map( ( icon, index ) => (
									<Button
										key={ index }
										label={ icon?.label }
										isPressed={ currentIcon === icon.value }
										className="button-icon-picker__button"
										onClick={ () =>
											setAttributes( {
												icon:
													currentIcon === icon.value
														? null
														: icon.value,
											} )
										}
									>
										<Icon icon={<SVG aria-hidden="false" viewBox="0 0 24 24">
											<use href={`http://localhost:8080/wp-content/themes/base-theme/assets/svg/icons.svg#${icon.value}`}></use>
										</SVG>} />

									</Button>
								) ) }
							</Grid>
						</PanelRow>

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

/**
 * Add icon and position classes in the Editor.
 *
 * @since 0.1.0
 * @param {Object} BlockListBlock
 */
function addClasses( BlockListBlock ) {
	return ( props ) => {
		const { name, attributes } = props;

		if ( 'core/button' !== name || ! attributes?.icon ) {
			return <BlockListBlock { ...props } />;
		}

		const classes = classnames( props?.className, {
			[ `has-icon__${ attributes?.icon }` ]: attributes?.icon,
			'has-icon-position__left': attributes?.iconPosition,
		} );

		return <BlockListBlock { ...props } className={ classes } />;
	};
}

addFilter(
	'editor.BlockListBlock',
	'core-button/add-classes',
	addClasses
);
