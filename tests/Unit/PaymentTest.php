<?php

namespace Tests\Unit;

use App\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    /** @test */
    public function a_payment_can_display_dollar_amount()
    {
        $payment = factory(Payment::class)->make([
            'client_id' => 1,
            'project_id' => 1,
            'amount' => 5963
        ]);

        $this->assertEquals('59', $payment->dollar_amount);
    }

    /** @test */
    public function a_payment_can_display_cent_amount()
    {
        $payment1 = factory(Payment::class)->make([
            'client_id' => 1,
            'project_id' => 1,
            'amount' => 5960
        ]);
        $payment2 = factory(Payment::class)->make([
            'client_id' => 1,
            'project_id' => 1,
            'amount' => 5966
        ]);

        $this->assertEquals('60', $payment1->cent_amount);
        $this->assertEquals('66', $payment2->cent_amount);
    }
}
