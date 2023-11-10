<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SocialLink;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SocialLinkControllerTest extends TestCase
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
    public function it_displays_index_view_with_social_links(): void
    {
        $socialLinks = SocialLink::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('social-links.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.social_links.index')
            ->assertViewHas('socialLinks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_social_link(): void
    {
        $response = $this->get(route('social-links.create'));

        $response->assertOk()->assertViewIs('app.social_links.create');
    }

    /**
     * @test
     */
    public function it_stores_the_social_link(): void
    {
        $data = SocialLink::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('social-links.store'), $data);

        $this->assertDatabaseHas('social_links', $data);

        $socialLink = SocialLink::latest('id')->first();

        $response->assertRedirect(route('social-links.edit', $socialLink));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_social_link(): void
    {
        $socialLink = SocialLink::factory()->create();

        $response = $this->get(route('social-links.show', $socialLink));

        $response
            ->assertOk()
            ->assertViewIs('app.social_links.show')
            ->assertViewHas('socialLink');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_social_link(): void
    {
        $socialLink = SocialLink::factory()->create();

        $response = $this->get(route('social-links.edit', $socialLink));

        $response
            ->assertOk()
            ->assertViewIs('app.social_links.edit')
            ->assertViewHas('socialLink');
    }

    /**
     * @test
     */
    public function it_updates_the_social_link(): void
    {
        $socialLink = SocialLink::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'icon' => $this->faker->text(255),
            'link' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('social-links.update', $socialLink),
            $data
        );

        $data['id'] = $socialLink->id;

        $this->assertDatabaseHas('social_links', $data);

        $response->assertRedirect(route('social-links.edit', $socialLink));
    }

    /**
     * @test
     */
    public function it_deletes_the_social_link(): void
    {
        $socialLink = SocialLink::factory()->create();

        $response = $this->delete(route('social-links.destroy', $socialLink));

        $response->assertRedirect(route('social-links.index'));

        $this->assertModelMissing($socialLink);
    }
}
