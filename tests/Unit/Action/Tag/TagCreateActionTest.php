<?php

namespace Tests\Unit\Action\Tag;

use App\Actions\Tag\TagCreateAction;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagCreateActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_tag()
    {
        $data = Tag::factory()->create();
        $tag = (new TagCreateAction())->execute($data->toArray());

        $this->assertInstanceOf(Tag::class, $tag);
    }
}
