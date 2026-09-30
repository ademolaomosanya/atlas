<?php

declare(strict_types=1);

namespace Atlas\Rest;

use Atlas\Content\ExperienceQueryArgs;
use WP_Post;
use WP_Query;
use WP_REST_Request;
use WP_REST_Response;

final class ExperiencesController {

	public static function register_routes(): void {
		register_rest_route(
			'atlas/v1',
			'/experiences',
			[
				'methods'             => 'GET',
				'callback'            => [ self::class, 'index' ],
				'permission_callback' => '__return_true',
				'args'                => [
					'page'     => [
						'default'           => 1,
						'sanitize_callback' => 'absint',
					],
					'per_page' => [
						'default'           => 10,
						'sanitize_callback' => 'absint',
					],
				],
			]
		);
	}

	public static function index( WP_REST_Request $request ): WP_REST_Response {
		$query = new WP_Query(
			ExperienceQueryArgs::for_public_list(
				(int) $request->get_param( 'page' ),
				(int) $request->get_param( 'per_page' )
			)
		);

		$items = array_map(
			[ self::class, 'prepare_item' ],
			$query->posts
		);

		$response = new WP_REST_Response( $items );
		$response->header( 'X-WP-Total', (string) $query->found_posts );
		$response->header( 'X-WP-TotalPages', (string) $query->max_num_pages );

		return $response;
	}

	private static function prepare_item( WP_Post $post ): array {
		$audience = get_post_meta( $post->ID, 'atlas_audience', true );
		$cta_url  = get_post_meta( $post->ID, 'atlas_cta_url', true );

		return [
			'id'       => $post->ID,
			'title'    => get_the_title( $post ),
			'excerpt'  => wp_strip_all_tags( get_the_excerpt( $post ) ),
			'audience' => is_string( $audience ) ? $audience : '',
			'cta_url'  => is_string( $cta_url ) ? $cta_url : '',
			'link'     => get_permalink( $post ),
		];
	}
}
