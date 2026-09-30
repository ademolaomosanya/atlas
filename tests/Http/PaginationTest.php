<?php

declare(strict_types=1);

namespace Atlas\Tests\Http;

use Atlas\Http\Pagination;
use PHPUnit\Framework\TestCase;

final class PaginationTest extends TestCase {

	public function test_page_never_drops_below_one(): void {
		$this->assertSame( 1, Pagination::page( 0 ) );
		$this->assertSame( 1, Pagination::page( -4 ) );
		$this->assertSame( 3, Pagination::page( 3 ) );
	}

	public function test_per_page_is_clamped(): void {
		$this->assertSame( 1, Pagination::per_page( 0 ) );
		$this->assertSame( 50, Pagination::per_page( 999 ) );
		$this->assertSame( 12, Pagination::per_page( 12 ) );
	}
}
