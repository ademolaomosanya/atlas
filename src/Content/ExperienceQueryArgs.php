<?php

declare(strict_types=1);

namespace Atlas\Content;

use Atlas\Http\Pagination;

final class ExperienceQueryArgs {

	public const POST_TYPE = 'atlas_experience';

	/**
	 * @return array<string, mixed>
	 */
	public static function for_public_list( int $page, int $per_page ): array {
		return [
			'post_type'              => self::POST_TYPE,
			'post_status'            => 'publish',
			'ignore_sticky_posts'    => true,
			'no_found_rows'          => false,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => false,
			'paged'                  => Pagination::page( $page ),
			'posts_per_page'         => Pagination::per_page( $per_page ),
		];
	}
}
