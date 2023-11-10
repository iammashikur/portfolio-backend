<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BlogCategory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogCategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_blog_categories(): void
    {
        $blogCategories = BlogCategory::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('blog-categories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.blog_categories.index')
            ->assertViewHas('blogCategories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_blog_category(): void
    {
        $response = $this->get(route('blog-categories.create'));

        $response->assertOk()->assertViewIs('app.blog_categories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_blog_category(): void
    {
        $data = BlogCategory::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('blog-categories.store'), $data);

        $this->assertDatabaseHas('blog_categories', $data);

        $blogCategory = BlogCategory::latest('id')->first();

        $response->assertRedirect(route('blog-categories.edit', $blogCategory));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_blog_category(): void
    {
        $blogCategory = BlogCategory::factory()->create();

        $response = $this->get(route('blog-categories.show', $blogCategory));

        $response
            ->assertOk()
            ->assertViewIs('app.blog_categories.show')
            ->assertViewHas('blogCategory');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_blog_category(): void
    {
        $blogCategory = BlogCategory::factory()->create();

        $response = $this->get(route('blog-categories.edit', $blogCategory));

        $response
            ->assertOk()
            ->assertViewIs('app.blog_categories.edit')
            ->assertViewHas('blogCategory');
    }

    /**
     * @test
     */
    public function it_updates_the_blog_category(): void
    {
        $blogCategory = BlogCategory::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'status' => $this->faker->numberBetween(0, 127),
        ];

        $response = $this->put(
            route('blog-categories.update', $blogCategory),
            $data
        );

        $data['id'] = $blogCategory->id;

        $this->assertDatabaseHas('blog_categories', $data);

        $response->assertRedirect(route('blog-categories.edit', $blogCategory));
    }

    /**
     * @test
     */
    public function it_deletes_the_blog_category(): void
    {
        $blogCategory = BlogCategory::factory()->create();

        $response = $this->delete(
            route('blog-categories.destroy', $blogCategory)
        );

        $response->assertRedirect(route('blog-categories.index'));

        $this->assertModelMissing($blogCategory);
    }
}
