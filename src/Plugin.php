<?php

declare(strict_types=1);

namespace Atlas;

use Atlas\Blocks\Registrar as BlockRegistrar;
use Atlas\Frontend\ExperienceContent;
use Atlas\Meta\EventMeta;
use Atlas\Meta\ExperienceMeta;
use Atlas\PostTypes\Event;
use Atlas\PostTypes\Experience;
use Atlas\Rest\ExperiencesController;

final class Plugin {

	public static function init(): void {
		add_action( 'init', [ self::class, 'register' ] );
		add_action( 'rest_api_init', [ ExperiencesController::class, 'register_routes' ] );
		add_action( 'enqueue_block_editor_assets', [ self::class, 'enqueue_editor_assets' ] );
		add_filter( 'the_content', [ ExperienceContent::class, 'append_details' ] );
		add_filter( 'should_load_separate_core_block_assets', '__return_true' );
	}

	public static function register(): void {
		Experience::register();
		ExperienceMeta::register();
		Event::register();
		EventMeta::register();
		BlockRegistrar::register();
	}

	public static function enqueue_editor_assets(): void {
		$asset_path = \ATLAS_PLUGIN_DIR . 'build/index.asset.php';

		if ( ! file_exists( $asset_path ) ) {
			return;
		}

		/** @var array{dependencies: string[], version: string} $asset */
		$asset = require $asset_path;

		wp_enqueue_script(
			'atlas-editor',
			\ATLAS_PLUGIN_URL . 'build/index.js',
			$asset['dependencies'],
			$asset['version'],
			true
		);
	}
}
