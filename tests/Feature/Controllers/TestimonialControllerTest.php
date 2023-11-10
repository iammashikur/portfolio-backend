<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Testimonial;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestimonialControllerTest extends TestCase
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
    public function it_displays_index_view_with_testimonials(): void
    {
        $testimonials = Testimonial::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('testimonials.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.testimonials.index')
            ->assertViewHas('testimonials');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_testimonial(): void
    {
        $response = $this->get(route('testimonials.create'));

        $response->assertOk()->assertViewIs('app.testimonials.create');
    }

    /**
     * @test
     */
    public function it_stores_the_testimonial(): void
    {
        $data = Testimonial::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('testimonials.store'), $data);

        $this->assertDatabaseHas('testimonials', $data);

        $testimonial = Testimonial::latest('id')->first();

        $response->assertRedirect(route('testimonials.edit', $testimonial));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_testimonial(): void
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->get(route('testimonials.show', $testimonial));

        $response
            ->assertOk()
            ->assertViewIs('app.testimonials.show')
            ->assertViewHas('testimonial');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_testimonial(): void
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->get(route('testimonials.edit', $testimonial));

        $response
            ->assertOk()
            ->assertViewIs('app.testimonials.edit')
            ->assertViewHas('testimonial');
    }

    /**
     * @test
     */
    public function it_updates_the_testimonial(): void
    {
        $testimonial = Testimonial::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'designation' => $this->faker->text(255),
            'status' => $this->faker->numberBetween(0, 127),
        ];

        $response = $this->put(
            route('testimonials.update', $testimonial),
            $data
        );

        $data['id'] = $testimonial->id;

        $this->assertDatabaseHas('testimonials', $data);

        $response->assertRedirect(route('testimonials.edit', $testimonial));
    }

    /**
     * @test
     */
    public function it_deletes_the_testimonial(): void
    {
        $testimonial = Testimonial::factory()->create();

        $response = $this->delete(route('testimonials.destroy', $testimonial));

        $response->assertRedirect(route('testimonials.index'));

        $this->assertModelMissing($testimonial);
    }
}
