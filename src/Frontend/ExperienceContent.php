<?php

declare(strict_types=1);

namespace Atlas\Frontend;

final class ExperienceContent {

	public static function append_details( string $content ): string {
		if ( ! is_singular( 'atlas_experience' ) || ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}

		$post_id  = get_the_ID();
		$audience = is_int( $post_id ) ? get_post_meta( $post_id, 'atlas_audience', true ) : '';
		$cta_url  = is_int( $post_id ) ? get_post_meta( $post_id, 'atlas_cta_url', true ) : '';

		$parts = [];

		if ( is_string( $audience ) && $audience !== '' ) {
			$parts[] = sprintf(
				'<p class="atlas-experience-audience"><span class="screen-reader-text">%s </span>%s</p>',
				esc_html__( 'Audience:', 'atlas' ),
				esc_html( $audience )
			);
		}

		if ( is_string( $cta_url ) && $cta_url !== '' ) {
			$parts[] = sprintf(
				'<p class="atlas-experience-cta"><a href="%s">%s</a></p>',
				esc_url( $cta_url ),
				esc_html__( 'Open this experience', 'atlas' )
			);
		}

		if ( $parts === [] ) {
			return $content;
		}

		return $content . implode( '', $parts );
	}
}
