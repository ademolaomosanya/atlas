<?php

declare(strict_types=1);

namespace Atlas\Meta;

use Atlas\Security\MetaAccess;

final class ExperienceMeta {

	public static function register(): void {
		register_post_meta(
			'atlas_experience',
			'atlas_audience',
			[
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => [ MetaAccess::class, 'can_edit' ],
			]
		);

		register_post_meta(
			'atlas_experience',
			'atlas_cta_url',
			[
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'esc_url_raw',
				'auth_callback'     => [ MetaAccess::class, 'can_edit' ],
			]
		);
	}
}
