<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        // $this->call(BlogSeeder::class);
        // $this->call(BlogCategorySeeder::class);
        // $this->call(BlogCommentSeeder::class);
        // $this->call(ExperienceSeeder::class);
        // $this->call(MessageSeeder::class);
        // $this->call(ProjectSeeder::class);
        // $this->call(ProjectCategorySeeder::class);
        // $this->call(QualificationSeeder::class);
        // $this->call(SkillSeeder::class);
        // $this->call(SocialLinkSeeder::class);
        // $this->call(TestimonialSeeder::class);
        // $this->call(ToolSeeder::class);
        $this->call(UserSeeder::class);
    }
}
