<?php

declare(strict_types=1);

namespace Atlas\PostTypes;

final class Event {

    public static function register(): void {
        register_post_type(
            'atlas_event',
            [
                'labels' => [
                    'name'          => 'Events',
                    'singular_name' => 'Event',
                ],
                'public'       => true,
                'show_in_rest' => true,
                'supports'     => [
                    'title',
                    'editor',
                    'excerpt',
                    'thumbnail',
                ],
                'has_archive'  => true,
                'rewrite'      => [
                    'slug' => 'events',
                ],
            ]
        );
    }
}
