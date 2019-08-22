<?php

namespace Tests\Unit;

use App\Client;
use App\Payment;
use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_client_can_display_all_remaining_balance()
    {
        $client = factory(Client::class)->create(['name' => 'George']);
        $project1 = factory(Project::class)->create(['amount' => 6000, 'client_id' => 1]);
        $project2 = factory(Project::class)->create(['amount' => 4000, 'client_id' => $client->id]);
        $payment1 = factory(Payment::class)->create([
            'amount' => 2000,
            'client_id' => $client->id,
            'project_id' => $project1->id,
        ]);

        $this->assertEquals(8000, $client->getAllRemainingBalance());

    }
}
