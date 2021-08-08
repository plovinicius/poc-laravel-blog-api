<?php

namespace Tests\Feature\Api;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTagControllerTest extends TestCase
{
    use RefreshDatabase;

    protected array $tagJson = [
        'name',
        'slug',
    ];

    protected string $resourceModel = 'App\Models\Tag';

    public function test_can_fetch_all_tags()
    {
        Tag::factory(30)->create();

        $response = $this->get(route('api.tags.index'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => $this->tagJson,
            ],
        ]);
    }

    public function test_can_create_new_tag()
    {
        $tag = Tag::factory()->make()->toArray();

        $response = $this->post(route('api.tags.store'), $tag);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tags', $tag);
    }
}
