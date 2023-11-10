<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Tool;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ToolControllerTest extends TestCase
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
    public function it_displays_index_view_with_tools(): void
    {
        $tools = Tool::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('tools.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.tools.index')
            ->assertViewHas('tools');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_tool(): void
    {
        $response = $this->get(route('tools.create'));

        $response->assertOk()->assertViewIs('app.tools.create');
    }

    /**
     * @test
     */
    public function it_stores_the_tool(): void
    {
        $data = Tool::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('tools.store'), $data);

        $this->assertDatabaseHas('tools', $data);

        $tool = Tool::latest('id')->first();

        $response->assertRedirect(route('tools.edit', $tool));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_tool(): void
    {
        $tool = Tool::factory()->create();

        $response = $this->get(route('tools.show', $tool));

        $response
            ->assertOk()
            ->assertViewIs('app.tools.show')
            ->assertViewHas('tool');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_tool(): void
    {
        $tool = Tool::factory()->create();

        $response = $this->get(route('tools.edit', $tool));

        $response
            ->assertOk()
            ->assertViewIs('app.tools.edit')
            ->assertViewHas('tool');
    }

    /**
     * @test
     */
    public function it_updates_the_tool(): void
    {
        $tool = Tool::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->put(route('tools.update', $tool), $data);

        $data['id'] = $tool->id;

        $this->assertDatabaseHas('tools', $data);

        $response->assertRedirect(route('tools.edit', $tool));
    }

    /**
     * @test
     */
    public function it_deletes_the_tool(): void
    {
        $tool = Tool::factory()->create();

        $response = $this->delete(route('tools.destroy', $tool));

        $response->assertRedirect(route('tools.index'));

        $this->assertModelMissing($tool);
    }
}
