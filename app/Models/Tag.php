<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_active'
    ];

    public function scopeFiltered($query, $filters)
    {
        return $query->when(!empty($filters), function($q) use ($filters) {
           foreach($filters as $filter) {
               if (!$filter['term']) {
                   continue;
               }

               $term = $filter['compare'] === 'LIKE' ? "%{$filter['term']}%" : $filter['term'];
               $q->where($filter['field'], $filter['compare'], $term);
           }
        });
    }
}
