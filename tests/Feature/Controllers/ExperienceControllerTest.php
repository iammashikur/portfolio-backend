<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Experience;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExperienceControllerTest extends TestCase
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
    public function it_displays_index_view_with_experiences(): void
    {
        $experiences = Experience::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('experiences.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.experiences.index')
            ->assertViewHas('experiences');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_experience(): void
    {
        $response = $this->get(route('experiences.create'));

        $response->assertOk()->assertViewIs('app.experiences.create');
    }

    /**
     * @test
     */
    public function it_stores_the_experience(): void
    {
        $data = Experience::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('experiences.store'), $data);

        $this->assertDatabaseHas('experiences', $data);

        $experience = Experience::latest('id')->first();

        $response->assertRedirect(route('experiences.edit', $experience));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_experience(): void
    {
        $experience = Experience::factory()->create();

        $response = $this->get(route('experiences.show', $experience));

        $response
            ->assertOk()
            ->assertViewIs('app.experiences.show')
            ->assertViewHas('experience');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_experience(): void
    {
        $experience = Experience::factory()->create();

        $response = $this->get(route('experiences.edit', $experience));

        $response
            ->assertOk()
            ->assertViewIs('app.experiences.edit')
            ->assertViewHas('experience');
    }

    /**
     * @test
     */
    public function it_updates_the_experience(): void
    {
        $experience = Experience::factory()->create();

        $data = [
            'company' => $this->faker->text(255),
            'designation' => $this->faker->text(255),
            'from_date' => $this->faker->date(),
            'to_date' => $this->faker->date(),
            'status' => $this->faker->numberBetween(0, 127),
        ];

        $response = $this->put(route('experiences.update', $experience), $data);

        $data['id'] = $experience->id;

        $this->assertDatabaseHas('experiences', $data);

        $response->assertRedirect(route('experiences.edit', $experience));
    }

    /**
     * @test
     */
    public function it_deletes_the_experience(): void
    {
        $experience = Experience::factory()->create();

        $response = $this->delete(route('experiences.destroy', $experience));

        $response->assertRedirect(route('experiences.index'));

        $this->assertModelMissing($experience);
    }
}
