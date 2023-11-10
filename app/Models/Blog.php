<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'image',
        'title',
        'content',
        'keywords',
        'description',
        'blog_category_id',
        'status',
    ];

    protected $searchableFields = ['*'];

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function blogComments()
    {
        return $this->hasMany(BlogComment::class);
    }
}
