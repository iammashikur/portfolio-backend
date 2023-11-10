<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'icon', 'status', 'value'];

    protected $searchableFields = ['*'];
}
