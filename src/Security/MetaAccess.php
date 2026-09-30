<?php

declare(strict_types=1);

namespace Atlas\Security;

final class MetaAccess {

	public static function can_edit( bool $allowed, string $meta_key, int $post_id ): bool {
		unset( $allowed, $meta_key );

		return current_user_can( 'edit_post', $post_id );
	}
}
