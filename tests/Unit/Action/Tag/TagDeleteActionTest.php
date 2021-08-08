<?php

namespace Tests\Unit\Action\Tag;

use App\Actions\Tag\TagDeleteAction;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagDeleteActionTest extends TestCase
{
   use RefreshDatabase;

    public function test_can_delete_tag()
    {
        $tag = Tag::factory()->create();

        $result = (new TagDeleteAction())->execute($tag);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('tags', $tag->toArray());
    }
}
