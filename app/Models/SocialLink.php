<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialLink extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'icon', 'link'];

    protected $searchableFields = ['*'];

    protected $table = 'social_links';
}
