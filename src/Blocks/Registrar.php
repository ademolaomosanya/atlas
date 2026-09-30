<?php

declare(strict_types=1);

namespace Atlas\Blocks;

final class Registrar {

	public static function register(): void {
		$manifests = glob( \ATLAS_PLUGIN_DIR . 'blocks/*/block.json' );

		if ( ! is_array( $manifests ) ) {
			return;
		}

		foreach ( $manifests as $manifest ) {
			register_block_type( dirname( $manifest ) );
		}
	}
}
