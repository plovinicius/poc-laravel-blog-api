<?php

namespace App\Http\Controllers\Api;

use App\Actions\Tag\TagCreateAction;
use App\Actions\Tag\TagDeleteAction;
use App\Actions\Tag\TagUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tag\TagCreateRequest;
use App\Http\Requests\Api\Tag\TagUpdateRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TagController extends Controller
{
    /**
     * @description List all tags
     *
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = [
            ['field' => 'name', 'compare' => 'LIKE', 'term' => $request->get('name')]
        ];

        $tags = Tag::filtered($filters)->paginate(config('utils.per_page'));

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
            // TODO: create custom exception or use translation message
            throw new Exception('Can\'t create a new tag, please, try again later.');
        }
    }

    /**
     * @description Update a tag
     *
     * @param Tag $tag
     * @param TagUpdateRequest $request
     * @param TagUpdateAction $updateAction
     *
     * @return TagResource
     * @throws Exception
     */
    public function update(Tag $tag, TagUpdateRequest $request, TagUpdateAction $updateAction): TagResource
    {
        try {
            $updatedTag = $updateAction->execute($tag, $request->validated());

            return new TagResource($updatedTag);
        } catch(Exception $ex) {
            // TODO: create custom exception or use translation message
            throw new Exception('Can\'t update this tag, please, try again later.');
        }
    }

    /**
     * @description Delete a tag
     *
     * @param Tag $tag
     * @param TagDeleteAction $deleteAction
     *
     * @return Response
     * @throws Exception
     */
    public function destroy(Tag $tag, TagDeleteAction $deleteAction): Response
    {
        try {
            $deleteAction->execute($tag);

            return response('Tag deleted successfully', 200);
        } catch (Exception $ex) {
            // TODO: create custom exception or use translation message
            throw new Exception('Can\'t delete this tag, please, try again later.');
        }
    }
}
