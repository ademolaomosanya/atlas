<?php

declare(strict_types=1);

namespace Atlas;

final class Plugin {

    public static function init(): void {
        add_action(
            'init',
            [ self::class, 'register' ]
        );
    }

    public static function register(): void {
        // Atlas initialization will live here.
    }
}
