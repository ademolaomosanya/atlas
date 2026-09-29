<?php

declare(strict_types=1);

namespace Atlas;

use Atlas\Meta\EventMeta;
use Atlas\PostTypes\Event;

final class Plugin {

    public static function init(): void {
        add_action(
            'init',
            [ Event::class, 'register' ]
        );

        add_action(
            'init',
            [ EventMeta::class, 'register' ]
        );
    }
}
