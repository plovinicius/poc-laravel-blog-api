<?php

namespace App\Http\Controllers\Api;

use App\Actions\Tag\TagCreateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tag\TagCreateRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TagController extends Controller
{
    /**
     * @description List all tags
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $tags = Tag::all();

        return TagResource::collection($tags);
    }

    /**
     * @description Create a new tag
     *
     * @param TagCreateRequest $request
     * @param TagCreateAction $createAction
     *
     * @return TagResource
     * @throws Exception
     */
    public function store(TagCreateRequest $request, TagCreateAction $createAction): TagResource
    {
        try {
            $tag = $createAction->execute($request->validated());

            return new TagResource($tag);
        } catch(Exception $ex) {
            throw new Exception('Can\'t create a new tag, please, try again later');
        }
    }
}
