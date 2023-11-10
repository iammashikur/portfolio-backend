<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Qualification;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QualificationControllerTest extends TestCase
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
    public function it_displays_index_view_with_qualifications(): void
    {
        $qualifications = Qualification::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('qualifications.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.qualifications.index')
            ->assertViewHas('qualifications');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_qualification(): void
    {
        $response = $this->get(route('qualifications.create'));

        $response->assertOk()->assertViewIs('app.qualifications.create');
    }

    /**
     * @test
     */
    public function it_stores_the_qualification(): void
    {
        $data = Qualification::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('qualifications.store'), $data);

        $this->assertDatabaseHas('qualifications', $data);

        $qualification = Qualification::latest('id')->first();

        $response->assertRedirect(route('qualifications.edit', $qualification));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_qualification(): void
    {
        $qualification = Qualification::factory()->create();

        $response = $this->get(route('qualifications.show', $qualification));

        $response
            ->assertOk()
            ->assertViewIs('app.qualifications.show')
            ->assertViewHas('qualification');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_qualification(): void
    {
        $qualification = Qualification::factory()->create();

        $response = $this->get(route('qualifications.edit', $qualification));

        $response
            ->assertOk()
            ->assertViewIs('app.qualifications.edit')
            ->assertViewHas('qualification');
    }

    /**
     * @test
     */
    public function it_updates_the_qualification(): void
    {
        $qualification = Qualification::factory()->create();

        $data = [
            'School' => $this->faker->text(255),
            'from_date' => $this->faker->date(),
            'to_date' => $this->faker->date(),
            'degree' => $this->faker->text(255),
            'status' => $this->faker->numberBetween(0, 127),
        ];

        $response = $this->put(
            route('qualifications.update', $qualification),
            $data
        );

        $data['id'] = $qualification->id;

        $this->assertDatabaseHas('qualifications', $data);

        $response->assertRedirect(route('qualifications.edit', $qualification));
    }

    /**
     * @test
     */
    public function it_deletes_the_qualification(): void
    {
        $qualification = Qualification::factory()->create();

        $response = $this->delete(
            route('qualifications.destroy', $qualification)
        );

        $response->assertRedirect(route('qualifications.index'));

        $this->assertModelMissing($qualification);
    }
}
