<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BlogComment;

use App\Models\Blog;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogCommentControllerTest extends TestCase
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
    public function it_displays_index_view_with_blog_comments(): void
    {
        $blogComments = BlogComment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('blog-comments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.blog_comments.index')
            ->assertViewHas('blogComments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_blog_comment(): void
    {
        $response = $this->get(route('blog-comments.create'));

        $response->assertOk()->assertViewIs('app.blog_comments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_blog_comment(): void
    {
        $data = BlogComment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('blog-comments.store'), $data);

        unset($data['parent_id']);

        $this->assertDatabaseHas('blog_comments', $data);

        $blogComment = BlogComment::latest('id')->first();

        $response->assertRedirect(route('blog-comments.edit', $blogComment));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_blog_comment(): void
    {
        $blogComment = BlogComment::factory()->create();

        $response = $this->get(route('blog-comments.show', $blogComment));

        $response
            ->assertOk()
            ->assertViewIs('app.blog_comments.show')
            ->assertViewHas('blogComment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_blog_comment(): void
    {
        $blogComment = BlogComment::factory()->create();

        $response = $this->get(route('blog-comments.edit', $blogComment));

        $response
            ->assertOk()
            ->assertViewIs('app.blog_comments.edit')
            ->assertViewHas('blogComment');
    }

    /**
     * @test
     */
    public function it_updates_the_blog_comment(): void
    {
        $blogComment = BlogComment::factory()->create();

        $blog = Blog::factory()->create();

        $data = [
            'name' => $this->faker->text(),
            'email' => $this->faker->email(),
            'comment' => $this->faker->text(),
            'parent_id' => $this->faker->randomNumber(),
            'blog_id' => $blog->id,
        ];

        $response = $this->put(
            route('blog-comments.update', $blogComment),
            $data
        );

        unset($data['parent_id']);

        $data['id'] = $blogComment->id;

        $this->assertDatabaseHas('blog_comments', $data);

        $response->assertRedirect(route('blog-comments.edit', $blogComment));
    }

    /**
     * @test
     */
    public function it_deletes_the_blog_comment(): void
    {
        $blogComment = BlogComment::factory()->create();

        $response = $this->delete(route('blog-comments.destroy', $blogComment));

        $response->assertRedirect(route('blog-comments.index'));

        $this->assertModelMissing($blogComment);
    }
}
