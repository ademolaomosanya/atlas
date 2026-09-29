<?php

declare(strict_types=1);

namespace Atlas\Meta;

final class EventMeta {

    public static function register(): void {
        register_post_meta(
            'atlas_event',
            'atlas_start_date',
            [
                'type'              => 'string',
                'single'            => true,
                'show_in_rest'      => true,
                'sanitize_callback' => 'sanitize_text_field',
                'auth_callback'     => static function (): bool {
                    return current_user_can( 'edit_posts' );
                },
            ]
        );

        register_post_meta(
            'atlas_event',
            'atlas_end_date',
            [
                'type'              => 'string',
                'single'            => true,
                'show_in_rest'      => true,
                'sanitize_callback' => 'sanitize_text_field',
                'auth_callback'     => static function (): bool {
                    return current_user_can( 'edit_posts' );
                },
            ]
        );

        register_post_meta(
            'atlas_event',
            'atlas_capacity',
            [
                'type'              => 'integer',
                'single'            => true,
                'show_in_rest'      => true,
                'sanitize_callback' => 'absint',
                'auth_callback'     => static function (): bool {
                    return current_user_can( 'edit_posts' );
                },
            ]
        );
    }
}
