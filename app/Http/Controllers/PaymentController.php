<?php

namespace App\Http\Controllers;

use App\Client;
use App\Payment;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create($client_id, $project_id)
    {
        $project = Project::where('id', $project_id)->with('client')->first();

        return view('payment.create')->withProject($project);
    }

    public function show($client_id, $project_id, $payment_id)
    {
        $payment = Payment::where('id', $payment_id)
            ->with('client')
            ->with('project')
            ->first();

        return view('payment.show')->withPayment($payment);
    }

    public function store(Request $request, $client_id, $project_id)
    {
        Payment::create([
            'amount' => request('amount') * 100,
            'client_id' => $client_id,
            'project_id' => $project_id,
            'paid_on' => request('paid_on') ?? Carbon::now(),
        ]);

        return redirect("/client/{$client_id}/project/{$project_id}");
    }

    public function update(Request $request, $client_id, $project_id, $payment_id)
    {
        $amount = (request('dollar_amount')*100)+request('cent_amount');
        $payment = Payment::findOrFail($payment_id)
            ->update([
                'amount' => $amount,
                'paid_on' => request('paid_on') ?? $this->paid_on
            ]);

        return redirect("/client/{$client_id}/project/{$project_id}");
    }
}
