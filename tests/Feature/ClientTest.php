<?php

namespace Tests\Feature;

use App\Client;
use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    private function withValidParams($array = null)
    {
        return array_merge([
            'name' => 'Test Client',
            'email' => 'john@example.com',
            'phone' => '6315551234'
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
    public function a_client_can_be_deleted()
    {
        $client = factory(Client::class)->create(['name' => 'Delete Me']);
        $this->assertDatabaseHas('clients', ['name' => 'Delete Me']);

        $response = $this->delete("/client/{$client->id}");
        $response->assertRedirect('/client');
        $this->assertDatabaseMissing('clients', ['name' => 'Delete Me']);
    }

    /** @test */
    public function a_client_can_be_created()
    {
        $response = $this->post('/api/client', [
            'name' => 'Test Client',
            'email' => 'john@example.com',
            'phone' => '6315551234'
        ]);

        tap(Client::first(), function ($client) {
            $this->assertEquals('Test Client', $client->name);
            $this->assertEquals('john@example.com', $client->email);
            $this->assertEquals('6315551234', $client->phone);
        });
    }

    //\//\//\//\//\//
    // Client Name
    //\//\//\//\//\//

    /** @test */
    public function the_client_name_is_required()
    {
        $response = $this->post('/api/client', $this->withValidParams([
            'name' => null,
        ]));

        $this->assertHasValidationError($response, 'name');
    }

    /** @test */
    public function the_client_name_must_be_at_least_3_characters_long()
    {
        $response = $this->post('/api/client', $this->withValidParams([
            'name' => 'ab',
        ]));

        $this->assertHasValidationError($response, 'name');
    }

    /** @test */
    public function the_client_name_must_be_less_than_255_characters_long()
    {
        $response = $this->post('/api/client', $this->withValidParams([
            'name' => implode('', array_fill(0,256,'a')),
        ]));

        $this->assertHasValidationError($response, 'name');
    }

    //\//\//\//\//\//
    // Client Email
    //\//\//\//\//\//

    /** @test */
    public function the_client_email_is_required()
    {
        $response = $this->post('/api/client', $this->withValidParams([
            'email' => null,
        ]));

        $this->assertHasValidationError($response, 'email');
    }

    /** @test */
    public function the_client_email_must_be_an_email()
    {
        $response = $this->post('/api/client', $this->withValidParams([
            'email' => 'invalid-email',
        ]));

        $this->assertHasValidationError($response, 'email');
    }

    /** @test */
    public function the_client_email_must_be_unique()
    {
        $client_1 = factory(Client::class)->create(['email' => 'john@example.com']);
        $response = $this->post('/api/client', $this->withValidParams([
            'email' => 'john@example.com',
        ]));

        $this->assertHasValidationError($response, 'email');
    }

    //\//\//\//\//\//
    // Client Phone
    //\//\//\//\//\//

    /** @test */
    public function client_phone_number_is_optional()
    {
        $response = $this->post('/api/client', $this->withValidParams([
            'phone' => null,
        ]));

        $this->assertEquals(1, Client::count());
    }

    /** @test */
    public function client_phone_must_be_a_valid_phone_number()
    {
        $response = $this->post('/api/client', $this->withValidParams([
            'phone' => 'invalid',
        ]));

        $this->assertHasValidationError($response, 'phone');
    }
}
