<?php

namespace Tests\Feature\Api;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTagControllerTest extends TestCase
{
    use RefreshDatabase;

    protected array $tagJson = [
        'id',
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

    public function test_can_update_tag()
    {
        $tag = Tag::factory()->create();

        $data = [
            'tag' => $tag->id,
            'name' => 'test update tag',
            'slug' => 'test-update-tag',
        ];

        $response = $this->put(route('api.tags.update', $data));

        $response->assertStatus(200);
        unset($data['tag']);
        $this->assertDatabaseHas('tags', $data);
    }
}
