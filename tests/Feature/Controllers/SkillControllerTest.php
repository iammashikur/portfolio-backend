<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Skill;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SkillControllerTest extends TestCase
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
    public function it_displays_index_view_with_skills(): void
    {
        $skills = Skill::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('skills.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.skills.index')
            ->assertViewHas('skills');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_skill(): void
    {
        $response = $this->get(route('skills.create'));

        $response->assertOk()->assertViewIs('app.skills.create');
    }

    /**
     * @test
     */
    public function it_stores_the_skill(): void
    {
        $data = Skill::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('skills.store'), $data);

        $this->assertDatabaseHas('skills', $data);

        $skill = Skill::latest('id')->first();

        $response->assertRedirect(route('skills.edit', $skill));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_skill(): void
    {
        $skill = Skill::factory()->create();

        $response = $this->get(route('skills.show', $skill));

        $response
            ->assertOk()
            ->assertViewIs('app.skills.show')
            ->assertViewHas('skill');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_skill(): void
    {
        $skill = Skill::factory()->create();

        $response = $this->get(route('skills.edit', $skill));

        $response
            ->assertOk()
            ->assertViewIs('app.skills.edit')
            ->assertViewHas('skill');
    }

    /**
     * @test
     */
    public function it_updates_the_skill(): void
    {
        $skill = Skill::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'status' => $this->faker->word(),
            'value' => $this->faker->randomNumber(0),
        ];

        $response = $this->put(route('skills.update', $skill), $data);

        $data['id'] = $skill->id;

        $this->assertDatabaseHas('skills', $data);

        $response->assertRedirect(route('skills.edit', $skill));
    }

    /**
     * @test
     */
    public function it_deletes_the_skill(): void
    {
        $skill = Skill::factory()->create();

        $response = $this->delete(route('skills.destroy', $skill));

        $response->assertRedirect(route('skills.index'));

        $this->assertModelMissing($skill);
    }
}
