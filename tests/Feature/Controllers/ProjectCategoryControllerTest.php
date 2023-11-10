<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ProjectCategory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectCategoryControllerTest extends TestCase
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
    public function it_displays_index_view_with_project_categories(): void
    {
        $projectCategories = ProjectCategory::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('project-categories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.project_categories.index')
            ->assertViewHas('projectCategories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_project_category(): void
    {
        $response = $this->get(route('project-categories.create'));

        $response->assertOk()->assertViewIs('app.project_categories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_project_category(): void
    {
        $data = ProjectCategory::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('project-categories.store'), $data);

        $this->assertDatabaseHas('project_categories', $data);

        $projectCategory = ProjectCategory::latest('id')->first();

        $response->assertRedirect(
            route('project-categories.edit', $projectCategory)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_project_category(): void
    {
        $projectCategory = ProjectCategory::factory()->create();

        $response = $this->get(
            route('project-categories.show', $projectCategory)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.project_categories.show')
            ->assertViewHas('projectCategory');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_project_category(): void
    {
        $projectCategory = ProjectCategory::factory()->create();

        $response = $this->get(
            route('project-categories.edit', $projectCategory)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.project_categories.edit')
            ->assertViewHas('projectCategory');
    }

    /**
     * @test
     */
    public function it_updates_the_project_category(): void
    {
        $projectCategory = ProjectCategory::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'status' => $this->faker->numberBetween(0, 127),
        ];

        $response = $this->put(
            route('project-categories.update', $projectCategory),
            $data
        );

        $data['id'] = $projectCategory->id;

        $this->assertDatabaseHas('project_categories', $data);

        $response->assertRedirect(
            route('project-categories.edit', $projectCategory)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_project_category(): void
    {
        $projectCategory = ProjectCategory::factory()->create();

        $response = $this->delete(
            route('project-categories.destroy', $projectCategory)
        );

        $response->assertRedirect(route('project-categories.index'));

        $this->assertModelMissing($projectCategory);
    }
}
