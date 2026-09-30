<?php

declare(strict_types=1);

namespace Atlas\Tests\Content;

use Atlas\Content\ExperienceQueryArgs;
use PHPUnit\Framework\TestCase;

final class ExperienceQueryArgsTest extends TestCase {

	public function test_public_list_only_requests_published_experiences(): void {
		$args = ExperienceQueryArgs::for_public_list( 0, 100 );

		$this->assertSame( 'atlas_experience', $args['post_type'] );
		$this->assertSame( 'publish', $args['post_status'] );
		$this->assertSame( 1, $args['paged'] );
		$this->assertSame( 50, $args['posts_per_page'] );
	}
}
