<?php

namespace Tests\Feature\Api;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTagControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $tagJson = [
        'name',
        'slug',
    ];

    protected $resourceModel = 'App\Models\Tag';

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
}
