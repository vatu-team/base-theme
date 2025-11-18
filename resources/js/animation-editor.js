/**
 * Animation Editor
 *
 * Registers a custom Gutenberg block sidebar panel for animation controls.
 */

import { addFilter } from '@wordpress/hooks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, PanelRow, SelectControl, RangeControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useSelect, useDispatch } from '@wordpress/data';
import { useEffect, createElement } from '@wordpress/element';

const AnimationControls = (props) => {
	const { attributes, setAttributes, clientId } = props;

	const { updateBlockAttributes } = useDispatch('core/block-editor');

	// Get current animation settings from block attributes only
	const animationSettings = attributes?.animation || {};

	// Helper function to apply Animate.css classes to DOM element
	const applyAnimateClasses = (element, animationType, trigger = 'scroll') => {
		if (!element || !animationType) return;

		// Remove any existing animate classes
		const existingClasses = element.className.split(' ').filter(cls =>
			!cls.startsWith('animate__')
		);

		// Add the base animate class and specific animation
		if (animationType) {
			existingClasses.push('animate__animated', `animate__${animationType}`);

			// Add trigger-specific classes if needed
			if (trigger === 'hover') {
				// For hover animations, we'll handle this with CSS :hover pseudo-class
				element.setAttribute('data-animate-trigger', 'hover');
			} else if (trigger === 'scroll') {
				// For scroll animations, we'll add a class that JavaScript can detect
				element.setAttribute('data-animate-trigger', 'scroll');
			}
		}

		element.className = existingClasses.join(' ');
	};

	// Helper function to trigger preview animation
	const triggerPreviewAnimation = (animationType, duration = 1000, delay = 0, blockClientId = clientId) => {
		if (!blockClientId || !animationType) return;

		// Find the element using our existing logic
		const findElementInDocument = (doc) => {
			const selectors = [
				`[data-block="${blockClientId}"]`,
				`#block-${blockClientId}`,
				`.wp-block[data-block="${blockClientId}"]`,
				`.block-editor-block-list__block[data-block="${blockClientId}"]`,
				`.is-selected`,
				`.block-editor-block-list__block.is-selected`,
			];

			for (const selector of selectors) {
				const element = doc.querySelector(selector);
				if (element) return element;
			}
			return null;
		};

		// Check main document first
		let element = findElementInDocument(document);

		// If not found, check iframe
		if (!element) {
			const iframes = document.querySelectorAll('iframe');
			for (const iframe of iframes) {
				try {
					const iframeDoc = iframe.contentDocument || iframe.contentWindow?.document;
					if (iframeDoc) {
						element = findElementInDocument(iframeDoc);
						if (element) break;
					}
				} catch (error) {
					// Skip inaccessible iframes
				}
			}
		}

		if (element) {
			// Remove any existing preview classes
			element.classList.remove('animate__preview', 'animate__preview-temp');

			// Ensure animation classes are present
			if (!element.classList.contains('animate__animated')) {
				element.classList.add('animate__animated');
			}
			if (!element.classList.contains(`animate__${animationType}`)) {
				element.classList.add(`animate__${animationType}`);
			}

			// Set custom properties
			element.style.setProperty('--animate-duration', `${duration}ms`);
			element.style.setProperty('--animate-delay', `${delay}ms`);

			// Force reflow
			element.offsetHeight;

			// Add preview class to trigger animation
			element.classList.add('animate__preview');

			// Remove preview class after animation completes
			setTimeout(() => {
				element.classList.remove('animate__preview');
			}, duration + delay + 100);
		}
	};

	const updateAnimation = (key, value) => {
		// If animation type is being set to empty/none, clear the entire animation attribute
		if (key === 'type' && (!value || value === '')) {
			setAttributes({
				animation: undefined, // Remove the animation attribute entirely
			});

			// Remove animation classes from DOM element
			const blockElement = document.querySelector(`[data-block="${clientId}"]`);
			if (blockElement) {
				// Remove all animate classes
				const existingClasses = blockElement.className.split(' ').filter(cls =>
					!cls.startsWith('animate__')
				);
				blockElement.className = existingClasses.join(' ').trim();

				// Remove CSS custom properties
				blockElement.style.removeProperty('--animate-duration');
				blockElement.style.removeProperty('--animate-delay');
			}
			return;
		}

		// Prepare the new structured animation attribute (attributes only, no className)
		const currentAnimationAttr = attributes.animation || {};
		const newStructuredAnimation = {
			...currentAnimationAttr,
			source: 'block', // Keep the source as block
			[key]: value, // Update the specific key that changed
		};

		// Only store in animation attribute - PHP will handle CSS classes
		setAttributes({
			animation: newStructuredAnimation,
		});

		// Apply classes to the actual DOM element in the editor for preview (but animations are disabled by CSS)
		const blockElement = document.querySelector(`[data-block="${clientId}"]`);
		if (blockElement && newStructuredAnimation.type) {
			applyAnimateClasses(blockElement, newStructuredAnimation.type, newStructuredAnimation.trigger);

			// Set CSS custom properties for preview
			if (newStructuredAnimation.duration) {
				blockElement.style.setProperty('--animate-duration', `${newStructuredAnimation.duration}ms`);
			}
			if (newStructuredAnimation.delay) {
				blockElement.style.setProperty('--animate-delay', `${newStructuredAnimation.delay}ms`);
			}
		}

		// If animation type changed, trigger a preview
		if (key === 'type' && value && value !== animationSettings.type) {
			setTimeout(() => {
				triggerPreviewAnimation(value, newStructuredAnimation.duration || 1000, newStructuredAnimation.delay || 0, clientId);
			}, 50);
		}
	};

	const animationTypes = [
		{ label: __('None', 'base-theme'), value: '' },
		...Object.entries(l10n.supportedAnimateCssAnimations).map(([value, label]) => ({
			label,
			value
		}))
	];

	const triggerTypes = Object.entries(l10n.supportedTriggerTypes).map(([value, label]) => ({
		label,
		value
	}));

	// Apply animation classes to DOM element for editor preview only
	useEffect(() => {
		const blockElement = document.querySelector(`[data-block="${clientId}"]`);
		if (!blockElement) return;

		// If no animation type, clean up any existing animation classes
		if (!animationSettings.type) {
			// Remove all animate classes
			const existingClasses = blockElement.className.split(' ').filter(cls =>
				!cls.startsWith('animate__')
			);
			blockElement.className = existingClasses.join(' ').trim();

			// Remove CSS custom properties
			blockElement.style.removeProperty('--animate-duration');
			blockElement.style.removeProperty('--animate-delay');
			return;
		}

		// Apply animation classes for blocks that have animations
		applyAnimateClasses(blockElement, animationSettings.type, animationSettings.trigger);

		// Set CSS custom properties for when preview is triggered
		if (animationSettings.duration) {
			blockElement.style.setProperty('--animate-duration', `${animationSettings.duration}ms`);
		}
		if (animationSettings.delay) {
			blockElement.style.setProperty('--animate-delay', `${animationSettings.delay}ms`);
		}
	}, [clientId, animationSettings]);

	return (
		<InspectorControls>
			<PanelBody
				title={__('Animation', 'base-theme')}
				initialOpen={false}
			>
				{animationSettings.type && (
					<PanelRow>
						<button
							className="button button-secondary"
							style={{ width: '100%', marginBottom: '16px' }}
							onClick={() => {
								triggerPreviewAnimation(
									animationSettings.type,
									animationSettings.duration || 1000,
									animationSettings.delay || 0
								);
							}}
							disabled={!animationSettings.type}
						>
							{__('Preview Animation', 'base-theme')}
						</button>
					</PanelRow>
				)}

				<PanelRow>
					<SelectControl
						label={__('Animation Type', 'base-theme')}
						value={animationSettings.type || ''}
						options={animationTypes}
						onChange={(value) => updateAnimation('type', value)}
						help={__('Choose the type of animation to apply to this block.', 'base-theme')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
				</PanelRow>

				{animationSettings.type && (
					<>
						<PanelRow>
							<SelectControl
								label={__('Trigger', 'base-theme')}
								value={animationSettings.trigger || 'scroll'}
								options={triggerTypes}
								onChange={(value) => updateAnimation('trigger', value)}
								help={__('When should the animation be triggered?', 'base-theme')}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
						</PanelRow>

						<PanelRow>
							<RangeControl
								label={__('Duration (ms)', 'base-theme')}
								value={animationSettings.duration || 500}
								onChange={(value) => updateAnimation('duration', value)}
								min={100}
								max={3000}
								step={100}
								help={__('How long should the animation take to complete?', 'base-theme')}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
						</PanelRow>

						<PanelRow>
							<RangeControl
								label={__('Delay (ms)', 'base-theme')}
								value={animationSettings.delay || 0}
								onChange={(value) => updateAnimation('delay', value)}
								min={0}
								max={2000}
								step={100}
								help={__('How long to wait before starting the animation?', 'base-theme')}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
						</PanelRow>

						{animationSettings.trigger === 'scroll' && (
							<PanelRow>
								<RangeControl
									label={__('Scroll Offset (%)', 'base-theme')}
									value={animationSettings.scrollOffset || 75}
									onChange={(value) => updateAnimation('scrollOffset', value)}
									min={0}
									max={100}
									step={5}
									help={__('How much of the element should be visible before triggering?', 'base-theme')}
									__next40pxDefaultSize={true}
									__nextHasNoMarginBottom={true}
								/>
							</PanelRow>
						)}

						<PanelRow>
							<SelectControl
								label={__('Easing', 'base-theme')}
								value={animationSettings.easing || 'ease-out'}
								options={[
									{ label: __('Ease Out', 'base-theme'), value: 'ease-out' },
									{ label: __('Ease In', 'base-theme'), value: 'ease-in' },
									{ label: __('Ease In Out', 'base-theme'), value: 'ease-in-out' },
									{ label: __('Linear', 'base-theme'), value: 'linear' },
									{ label: __('Bounce', 'base-theme'), value: 'cubic-bezier(0.68, -0.55, 0.265, 1.55)' },
								]}
								onChange={(value) => updateAnimation('easing', value)}
								help={__('The timing function for the animation.', 'base-theme')}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
						</PanelRow>
					</>
				)}
			</PanelBody>
		</InspectorControls>
	);
};

const addAnimationControls = (BlockEdit) => (props) => {
	// Get the current block name to check if it's supported
	const blockName = useSelect((select) => {
		const { getBlockName } = select('core/block-editor');
		return getBlockName(props.clientId);
	}, [props.clientId]);

	// Check if this block type is supported for animations
	const isSupported = l10n.supportedBlocks && l10n.supportedBlocks.includes(blockName);

	return (
		<>
			<BlockEdit {...props} />
			{isSupported && <AnimationControls {...props} />}
		</>
	);
};

addFilter(
	'editor.BlockEdit',
	'base-theme/animation-controls',
	addAnimationControls
);
