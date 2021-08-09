<?php

namespace Tests\Unit\Action\Tag;

use App\Actions\Tag\TagUpdateAction;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagUpdateActionTest extends TestCase
{

    use RefreshDatabase;

    public function test_can_update_tag()
    {
        $tag = Tag::factory()->create();
        $data = [
            'name' => 'updated name',
            'slug' => 'updated-name',
            'is_active' => false
        ];

        (new TagUpdateAction())->execute($tag, $data);
        $this->assertDatabaseHas('tags', $data);
    }
}
