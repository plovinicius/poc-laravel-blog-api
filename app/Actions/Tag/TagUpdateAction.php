<?php

namespace App\Actions\Tag;

use Illuminate\Database\Eloquent\Model;

class TagUpdateAction
{
    public function execute(Model $tag, array $data): bool
    {
        return $tag->update($data);
    }
}
