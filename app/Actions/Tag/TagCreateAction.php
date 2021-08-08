<?php

namespace App\Actions\Tag;

use App\Models\Tag;

class TagCreateAction
{
    public function execute(array $data)
    {
        return Tag::create($data);
    }
}
