<?php

/**
 * Animation
 *
 * @package   Vatu\Wordpress\Theme\Client\BaseTheme
 * @author    Vatu <hello@vatu.dev>
 * @link      https://vatu.dev/
 * @license   GNU General Public License v3.0 or later
 * @copyright 2025 Vatu Limited.
 */

declare(strict_types=1);

namespace Client\BaseTheme\Domain;

use ThoughtsIdeas\Wordpress\Infrastructure\Services\Registrable;
use ThoughtsIdeas\Wordpress\Infrastructure\Services\Service;

final class Animation extends Service implements Registrable
{
	protected string $name = 'Animation';

	/**
	 * @var array<string>
	 */
	private array $supported_blocks = [
		'core/heading',
		'core/paragraph',
		'core/list',
		'core/group',
		'core/image',
		'core/video',
	];

	/**
	 * Supported Animate.css animations.
	 *
	 * @link https://animate.style/
	 *
	 * @var array<string>
	 */
	private array $supported_animate_css_animations = [
		// Fade in animations
		'fadeIn' => 'Fade In',
		'fadeInDown' => 'Fade In Down',
		'fadeInLeft' => 'Fade In Left',
		'fadeInRight' => 'Fade In Right',
		'fadeInUp' => 'Fade In Up',
	];

	/**
	 * Supported trigger types.
	 *
	 * @var array<string>
	 */
	private array $supported_trigger_types = [
		'scroll' => 'Scroll',
	];

	/**
	 * Default animations for specific block types.
	 *
	 * @var array<string, array<string, mixed>>
	 */
	private array $default_block_animations = [
		'core/heading' => [
			'type'         => 'fadeIn',
			'trigger'      => 'scroll',
			'duration'     => 800,
			'delay'        => 100,
			'scrollOffset' => 20,
			'repeat'       => false,
			'easing'       => 'ease-out',
		],
	];

	public function register(): void
	{
		\add_action(
			hook_name: 'enqueue_block_editor_assets',
			callback: [ $this, 'enqueueBlockEditor' ],
			priority: 10,
			accepted_args: 0
		);

		\add_action(
			hook_name: 'enqueue_block_assets',
			callback: [ $this, 'enqueueBlock' ],
			priority: 10,
			accepted_args: 0
		);

		\add_filter(
			hook_name: 'block_type_metadata',
			callback: [ $this, 'addAnimationAttributes' ],
			priority: 10,
			accepted_args: 1
		);

		\add_filter(
			hook_name: 'render_block',
			callback: [ $this, 'renderBlockWithAnimation' ],
			priority: 10,
			accepted_args: 2
		);
	}

	public function enqueueBlockEditor(): void
	{
		$script_asset_file = \get_theme_file_path( 'assets/js/animation-editor.asset.php' );
		$script_asset = file_exists( $script_asset_file ) ? include_once $script_asset_file : [];

		// Ensure we have a valid asset array structure
		if ( ! is_array( $script_asset ) ) {
			$script_asset = [];
		}

		\wp_register_script(
			handle: 'animation-editor',
			src: \get_theme_file_uri( file: '/assets/js/animation-editor.js' ),
			deps: $script_asset['dependencies'] ?? [],
			ver: $script_asset['version'] ?? '1.0.0'
		);

		wp_localize_script(
			handle: 'animation-editor',
			object_name: 'l10n',
			l10n: [
				'supportedBlocks'               => $this->getSupportedBlocks(),
				'supportedAnimateCssAnimations' => $this->getSupportedAnimateCssAnimations(),
				'supportedTriggerTypes' => $this->getSupportedTriggerTypes(),
			]
		);

		\wp_enqueue_script( handle: 'animation-editor' );
	}

	public function enqueueBlock(): void
	{
		\wp_enqueue_style(
			handle: 'animate-css',
			src: 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css'
		);

		// Enqueue animation editor CSS for both editor and frontend
		$style_asset_file = \get_theme_file_path( 'assets/css/animation-editor.asset.php' );
		$style_asset = file_exists( $style_asset_file ) ? include_once $style_asset_file : [];

		// Ensure we have a valid asset array structure
		if ( ! is_array( $style_asset ) ) {
			$style_asset = [];
		}

		\wp_enqueue_style(
			handle: 'animation-editor',
			src: \get_theme_file_uri( file: '/assets/css/animation-editor.css' ),
			deps: $style_asset['dependencies'] ?? [],
			ver: $style_asset['version'] ?? '1.0.0'
		);
	}

	/**
	 * Add animation attributes to all block types.
	 *
	 * @param array<string, mixed> $metadata Block type metadata.
	 * @return array<string, mixed> Modified metadata with animation attributes.
	 */
	public function addAnimationAttributes( array $metadata ): array
	{
		// Skip if attributes are not set (shouldn't happen, but safety first)
		if ( ! isset( $metadata['attributes'] ) ) {
			$metadata['attributes'] = [];
		}

		// Add grouped animation attribute with nested properties
		$metadata['attributes']['animation'] = [
			'type'    => 'object',
			'default' => [
				'source'       => 'block',
				'type'         => '',
				'trigger'      => 'scroll',
				'duration'     => 1000,
				'delay'        => 0,
				'scrollOffset' => 20,
				'repeat'       => false,
				'easing'       => 'ease-out',
			],
			'properties' => [
				'source' => [
					'type' => 'string',
				],
				'type' => [
					'type' => 'string',
				],
				'trigger' => [
					'type' => 'string',
				],
				'duration' => [
					'type' => 'number',
				],
				'delay' => [
					'type' => 'number',
				],
				'scrollOffset' => [
					'type' => 'number',
				],
				'repeat' => [
					'type' => 'boolean',
				],
				'easing' => [
					'type' => 'string',
				],
			],
		];

		return $metadata;
	}

	/**
	 * Filter block rendering to check for animation attributes.
	 *
	 * @param string $block_content The block content.
	 * @param array<string, mixed> $block The full block, including name and attributes.
	 * @return string Modified block content.
	 */
	public function renderBlockWithAnimation( string $block_content, array $block ): string
	{
		// Get the block name for checking defaults
		$block_name = $block['blockName'] ?? '';

		// Check if the block has animation attributes
		$animation = $block['attrs']['animation'] ?? null;

		// Determine animation settings (block-specific or defaults)
		$final_animation = $this->getEffectiveAnimation( $animation, $block_name );

		// If no effective animation, return content unchanged
		if ( empty( $final_animation ) || empty( $final_animation['type'] ) ) {
			return $block_content;
		}

		$animation_type = $final_animation['type'];
		$animation_trigger = $final_animation['trigger'] ?? 'scroll';
		$animation_duration = $final_animation['duration'] ?? 1000;
		$animation_delay = $final_animation['delay'] ?? 0;
		$animation_scroll_offset = $final_animation['scrollOffset'] ?? 20;

		// Only handle scroll trigger animations for now
		if ( $animation_trigger === 'scroll' ) {
			return $this->handleScrollAnimation(
				$block_content,
				$animation_type,
				$animation_duration,
				$animation_delay,
				$animation_scroll_offset
			);
		}

		// For now, we only support scroll triggers
		return $block_content;
	}

	/**
	 * Handle scroll-triggered animations.
	 *
	 * @param string $block_content The block content.
	 * @param string $animation_type The animation type.
	 * @param int    $duration Animation duration in milliseconds.
	 * @param int    $delay Animation delay in milliseconds.
	 * @param int    $scroll_offset Scroll offset percentage.
	 * @return string Modified block content with scroll animation support.
	 */
	private function handleScrollAnimation(
		string $block_content,
		string $animation_type,
		int $duration,
		int $delay,
		int $scroll_offset
	): string {
		// Generate a unique ID for this animated block
		$unique_id = 'animate-' . \uniqid();

		// Use HTML_Tag_Processor to add the ID to the first element
		$processor = new \WP_HTML_Tag_Processor( $block_content );

		if ( $processor->next_tag() ) {
			// Add unique ID
			$processor->set_attribute( 'id', $unique_id );

			// Add data attributes for animation configuration (only what we need)
			$processor->set_attribute( 'data-animate-type', $animation_type );

			$current_style = $processor->get_attribute( 'style' ) ?? '';

			// Add CSS custom properties for animation timing
			$style_additions = [];
			$style_additions[] = "--animate-duration: {$duration}ms";
			$style_additions[] = "--animate-delay: {$delay}ms";

			// Hide entrance animations initially
			if ( $this->isEntranceAnimation( $animation_type ) ) {
				$style_additions[] = 'opacity: 0';
			}

			$new_style = $current_style
				? $current_style . '; ' . \implode( '; ', $style_additions )
				: \implode( '; ', $style_additions );
			$processor->set_attribute( 'style', $new_style );

			$modified_content = $processor->get_updated_html();
		} else {
			// Fallback if no HTML tags found
			$modified_content = $block_content;
		}

		// Generate the JavaScript for scroll detection
		$script = $this->generateScrollAnimationScript( $unique_id, $scroll_offset, $duration, $delay );

		return $modified_content . $script;
	}

	/**
	 * Get the effective animation settings for a block.
	 *
	 * This method determines whether to use block-specific animation settings
	 * or fall back to default animations for the block type.
	 *
	 * @param array<string, mixed>|null $block_animation Block-specific animation settings.
	 * @param string $block_name The block type name.
	 * @return array<string, mixed>|null Effective animation settings or null if no animation.
	 */
	private function getEffectiveAnimation( null|array $block_animation, string $block_name ): null|array
	{
		// If block has explicit animation settings with source 'block', use them
		if (
			! empty( $block_animation ) &&
			! empty( $block_animation['type'] ) &&
			$block_animation['type'] !== 'none' &&
			( $block_animation['source'] ?? 'block' ) === 'block'
		) {
			return $block_animation;
		}

		// If block has explicit "none" animation (user chose "None"), respect that
		if (
			! empty( $block_animation ) &&
			$block_animation['type'] === 'none' &&
			( $block_animation['source'] ?? 'block' ) === 'block'
		) {
			// Explicit "no animation" - override any global defaults
			return null;
		}

		// If block animation is empty or null, check for global defaults
		// This handles the "Global" selection case
		if ( isset( $this->default_block_animations[ $block_name ] ) ) {
			$default_animation = $this->default_block_animations[ $block_name ];
			// Mark as coming from global defaults
			$default_animation['source'] = 'global';
			return $default_animation;
		}

		// No animation
		return null;
	}

	/**
	 * Generate JavaScript for scroll-triggered animations.
	 *
	 * @param string $element_id The unique element ID.
	 * @param int    $scroll_offset Scroll offset percentage.
	 * @param int    $duration Animation duration in milliseconds.
	 * @param int    $delay Animation delay in milliseconds.
	 * @return string JavaScript code wrapped in script tags.
	 */
	private function generateScrollAnimationScript(
		string $element_id,
		int $scroll_offset,
		int $duration,
		int $delay
	): string {
		return "
		<script>
		(function() {
			const element = document.getElementById('{$element_id}');
			if (!element) return;

			const animationType = element.getAttribute('data-animate-type');

			// Set CSS custom properties directly from PHP values
			element.style.setProperty('--animate-duration', '{$duration}ms');
			element.style.setProperty('--animate-delay', '{$delay}ms');

			// Intersection Observer for scroll detection
			const observer = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (entry.isIntersecting) {
						// Show element if it was hidden (entrance animations)
						entry.target.style.opacity = '1';
						// Add animation classes
						entry.target.classList.add('animate__animated', 'animate__' + animationType);
						// Stop observing once animated
						observer.unobserve(entry.target);
					}
				});
			}, {
				threshold: {$scroll_offset} / 100,
				rootMargin: '0px'
			});

			observer.observe(element);
		})();
		</script>";
	}

	/**
	 * @return array<string>
	 */
	private function getSupportedBlocks(): array
	{
		return $this->supported_blocks;
	}

	/**
	 * @return array<string, string>
	 */
	private function getSupportedAnimateCssAnimations(): array
	{
		return $this->supported_animate_css_animations;
	}

	/**
	 * @return array<string, string>
	 */
	private function getSupportedTriggerTypes(): array
	{
		return $this->supported_trigger_types;
	}

	/**
	 * Check if an animation type is an entrance animation that should start hidden.
	 *
	 * @param string $animation_type The animation type to check.
	 * @return bool True if it's an entrance animation.
	 */
	private function isEntranceAnimation( string $animation_type ): bool
	{
		// List of entrance animation patterns
		$entrance_patterns = [
			'fadeIn',
		];

		// Check if animation type starts with any entrance pattern
		foreach ( $entrance_patterns as $pattern ) {
			if ( \str_starts_with( $animation_type, $pattern ) ) {
				return true;
			}
		}

		return false;
	}
}
