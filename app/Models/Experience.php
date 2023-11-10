<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'company',
        'designation',
        'from_date',
        'to_date',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];
}
