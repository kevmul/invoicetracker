<?php

namespace Tests\Feature;

use App\Client;
use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();
        $this->client = factory(Client::class)->create();
    }

    private function withValidParams($array = null)
    {
        return array_merge([
            'title' => 'Test Project',
            'client_id' => $this->client->id,
            'amount' => 1000
        ], $array);
    }

    /**
     * Assert that the test has errors
     *
     * @param  String $field
     */
    private function assertHasValidationError($response, $field)
    {
        $response->assertStatus(302);
        $response->assertSessionHasErrors($field);
    }

    /*|========================================================
     | Tests
    |========================================================*/

    /** @test */
    public function a_project_can_be_shown_with_all_payments()
    {
        $unseenUser = factory(Client::class)->create(['name' => 'Unseen User']);
        $unseenProject = factory(Project::class)->create(['title' => 'Unseen Project', 'client_id' => $unseenUser]);

        $client = factory(Client::class)->create(['name' => 'John Doe']);
        $project = factory(Project::class)->create(['title' => 'My First Project', 'client_id' => $client->id]);

        $response = $this->get("/client/{$client->id}/project/{$project->id}");
        $response->assertStatus(200);

        $response->assertSee('My First Project');
    }

    /** @test */
    public function a_client_can_be_deleted()
    {
        $project = factory(Project::class)->create(['title' => 'Delete Me']);
        $this->assertDatabaseHas('projects', ['title' => 'Delete Me']);

        $response = $this->delete("/client/{$project->client_id}/project/{$project->id}");
        $response->assertRedirect("/client/1");
        $this->assertDatabaseMissing('projects', ['title' => 'Delete Me']);
    }

    /** @test */
    public function a_project_can_be_created()
    {
        $this->withoutExceptionHandling();
        $client = factory(Client::class)->create(['name' => 'Client']);
        $response = $this->post("/api/client/{$client->id}/project", [
            'title' => 'Test Project',
            'amount' => 10
        ]);

        $response->assertJsonFragment(['title' => 'Test Project']);

        tap(Project::first(), function ($project) {
            $this->assertEquals('Test Project', $project->title);
            $this->assertEquals(1000, $project->amount);
            $this->assertEquals('Client', $project->client->name);
        });
    }

    /** @test */
    public function the_project_title_is_required()
    {
        $response = $this->post("/api/client/{$this->client->id}/project", $this->withValidParams([
            'title' => null
        ]));

        $this->assertHasValidationError($response, 'title');
    }

    /** @test */
    public function the_project_title_must_be_at_least_3_characters_long()
    {
        $response = $this->post("/api/client/{$this->client->id}/project", $this->withValidParams([
            'title' => 'ab'
        ]));

        $this->assertHasValidationError($response, 'title');
    }

    /** @test */
    public function the_project_title_must_be_less_than_255_characters_long()
    {
        $response = $this->post("/api/client/{$this->client->id}/project", $this->withValidParams([
            'title' => implode('', array_fill(0, 256, 'a'))
        ]));

        $this->assertHasValidationError($response, 'title');
    }

    //\//\//\//\//\//
    // Amount
    //\//\//\//\//\//

    /** @test */
    public function the_amount_field_is_required()
    {
        $response = $this->post("/api/client/{$this->client->id}/project", $this->withValidParams([
            'amount' => null
        ]));

        $this->assertHasValidationError($response, 'amount');
    }

    /** @test */
    public function the_amount_field_must_be_an_integer()
    {
        $response = $this->post("/api/client/{$this->client->id}/project", $this->withValidParams([
            'amount' => 'invalid'
        ]));

        $this->assertHasValidationError($response, 'amount');
    }

    /** @test */
    public function the_amount_field_cannot_be_negative()
    {
        $response = $this->post("/api/client/{$this->client->id}/project", $this->withValidParams([
            'amount' => -1000
        ]));

        $this->assertHasValidationError($response, 'amount');
    }
}
