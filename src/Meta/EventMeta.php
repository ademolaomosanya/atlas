<?php

declare(strict_types=1);

namespace Atlas\Meta;

use Atlas\Security\MetaAccess;

final class EventMeta {

	public static function register(): void {
		$shared = [
			'single'       => true,
			'show_in_rest' => true,
			'auth_callback' => [ MetaAccess::class, 'can_edit' ],
		];

		register_post_meta(
			'atlas_event',
			'atlas_start_date',
			$shared + [
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			]
		);

		register_post_meta(
			'atlas_event',
			'atlas_end_date',
			$shared + [
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			]
		);

		register_post_meta(
			'atlas_event',
			'atlas_capacity',
			$shared + [
				'type'              => 'integer',
				'sanitize_callback' => 'absint',
			]
		);
	}
}
