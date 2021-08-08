<?php

namespace App\Actions\Tag;

use Illuminate\Database\Eloquent\Model;

class TagDeleteAction
{
    public function execute(Model $tag): bool
    {
        return $tag->delete();
    }
}
