<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Payment;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;

class ClientProjectPaymentsController extends Controller
{
    public function store(PaymentRequest $request, Client $client, Project $project)
    {
        $payment = Payment::create([
            'amount' => request('amount') * 100,
            'client_id' => $client->id,
            'project_id' => $project->id,
            'paid_on' => request('paid_on') ?? Carbon::now(),
        ]);
        return response()->json([
            'message' => 'success',
            'payment' => $payment
        ]);
    }

    public function update(PaymentRequest $request, Client $client, Project $project, Payment $payment)
    {
        $payment->update([
            'amount' => request('amount') ? request('amount') * 100 : $payment->amount,
            'paid_on' => request('paid_on') ?? $payment->paid_on
        ]);

        return response()->json([
            'message' => 'success',
            'payment' => $payment
        ]);
    }
}
