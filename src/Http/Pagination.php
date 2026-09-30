<?php

declare(strict_types=1);

namespace Atlas\Http;

final class Pagination {

	public static function page( int $page ): int {
		return max( 1, $page );
	}

	public static function per_page( int $per_page, int $max = 50 ): int {
		return min( $max, max( 1, $per_page ) );
	}
}
