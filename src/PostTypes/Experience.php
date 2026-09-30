<?php

declare(strict_types=1);

namespace Atlas\PostTypes;

final class Experience {

	public static function register(): void {
		register_post_type(
			'atlas_experience',
			[
				'labels'       => [
					'name'          => 'Experiences',
					'singular_name' => 'Experience',
					'add_new_item'  => 'Add Experience',
					'edit_item'     => 'Edit Experience',
				],
				'public'       => true,
				'show_in_rest' => true,
				'menu_icon'    => 'dashicons-layout',
				'supports'     => [
					'title',
					'editor',
					'excerpt',
					'thumbnail',
					'custom-fields',
				],
				'has_archive'  => true,
				'rewrite'      => [
					'slug' => 'experiences',
				],
			]
		);
	}
}
