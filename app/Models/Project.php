<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'image',
        'link',
        'project_category_id',
        'status',
    ];

    protected $searchableFields = ['*'];

    public function projectCategory()
    {
        return $this->belongsTo(ProjectCategory::class);
    }
}
