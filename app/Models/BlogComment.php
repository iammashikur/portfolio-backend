<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogComment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'email', 'comment', 'blog_id', 'parent_id'];

    protected $searchableFields = ['*'];

    protected $table = 'blog_comments';

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
