<?php

namespace Tests\Feature;

use App\Client;
use App\Payment;
use App\Project;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();
        $this->client = factory(Client::class)->create();
        factory(Project::class)->create(['client_id' => $this->client->id]);
    }

    private function withValidParams($array = null)
    {
        return array_merge([
            'amount' => 1000,
            'paid_on' => Carbon::now()
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

    /*|--------------------------------------------------------
     | Creating Payment
    |--------------------------------------------------------*/

    //\//\//\//\//\//
    // Amount
    //\//\//\//\//\//

    /** @test */
    public function the_amount_field_is_required()
    {
        $response = $this->post("/api/client/{$this->client->id}/project/{$this->client->projects[0]->id}/payment", $this->withValidParams([
            'amount' => null
        ]));

        $this->assertHasValidationError($response, 'amount');
    }

    /** @test */
    public function the_amount_field_must_be_an_integer()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post("/api/client/{$this->client->id}/project/{$this->client->projects[0]->id}/payment", $this->withValidParams([
            'amount' => 'invalid'
        ]));

        $this->assertHasValidationError($response, 'amount');
    }

    /** @test */
    public function the_amount_field_cannot_be_negative()
    {
        $response = $this->post("/api/client/{$this->client->id}/project/{$this->client->projects[0]->id}/payment", $this->withValidParams([
            'amount' => -1000
        ]));

        $this->assertHasValidationError($response, 'amount');
    }

    /*|--------------------------------------------------------
     | Editing Payment
    |--------------------------------------------------------*/

    /** @test */
    public function a_payment_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $payment = factory(Payment::class)->create([
            'amount' => 30
        ]);
        $response = $this->patch("/api/client/1/project/1/payment/{$payment->id}", $this->withValidParams([
            'amount' => 50
        ]));

        tap(Payment::first(), function($payment) {
            $this->assertEquals(5000, $payment->amount);
        });
    }

    /*|--------------------------------------------------------
     | Viewing Payment
    |--------------------------------------------------------*/

    /*|--------------------------------------------------------
     | Deleting Payment
    |--------------------------------------------------------*/




}
