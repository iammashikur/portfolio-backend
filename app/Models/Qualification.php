<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Qualification extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'School',
        'from_date',
        'to_date',
        'degree',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];
}
