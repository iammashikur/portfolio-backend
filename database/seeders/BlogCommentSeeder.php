<?php

namespace Database\Seeders;

use App\Models\BlogComment;
use Illuminate\Database\Seeder;

class BlogCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogComment::factory()
            ->count(5)
            ->create();
    }
}
